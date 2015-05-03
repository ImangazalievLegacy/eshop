<?php

class OrderController extends BaseController {

	public function getIndex()
	{
		$shippingMethods = Shipping::getMethods();
		$paymentMethods  = ['cash', 'bank_transfer']; 

		$data = ['shippingMethods' => $shippingMethods, 'paymentMethods' => $paymentMethods];

		if (!Auth::guest())
		{
			$userId = Auth::user()->id;

			$address = Address::getDefaultAddress($userId);

			if ($address !== null)
			{
				$data['address'] = $address;
			}
		}

		return View::make('themes.default.order.index')->with($data);
	}

	public function postMakeOrder()
	{
		$data = Input::all();

		$shippingMethods = Shipping::getTitles();
		$paymentMethods  = ['cash', 'bank_transfer'];

		$shippingMethods = implode(',', $shippingMethods);
		$paymentMethods = implode(',', $paymentMethods);

		$rules = array(

			'full_name'       => ['required', 'string', 'regex:/[^ ]* [^ ]*/'],
			'email'           => 'required|email',
			'phone_number'    => 'required',
			'comment'         => 'max:200',
			'shipping_method' => 'required|in:' . $shippingMethods,
			'payment_method'  => 'required|in:' . $paymentMethods,
		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::back()->withErrors($validator)->withInput($data);
		}

		$fullname       = Input::get('full_name');
		$email          = Input::get('email');
		$phoneNumber    = Input::get('phone_number');
		$comment        = Input::get('comment');
		$shippingMethod = Input::get('shipping_method');
		$paymentMethod  = Input::get('payment_method');
		$ipAddress      = Request::ip();

		list($firstname, $lastname) = explode(' ', $fullname);

		$userId       = -1;
		$addressId    = -1;

		if (Auth::guest())
		{
			$customerType = 'guest';
		}
		else
		{
			$customerType = 'user';
			$userId       = Auth::user()->id;

			$addresses = Address::getByOwnerId($userId);

			if ($addresses->count())
			{
				$addressId = (int) Input::get('address_id');
			}
			else
			{

				$addressId = Address::add(array(

					'owner_id'     => $userId,
					'full_name'    => $fullname,
					'phone_number' => $phoneNumber,

				), true);
				
			}
		}

		$productList = ['Product 1', 'Product 2', 'Product 3'];
		$productList = serialize($productList);
		$total = Cart::getTotal();

		$order = Order::create(array(

			'type'         => $customerType,
			'owner_id'     => $userId,
			'address_id'   => $addressId,
			'firstname'    => $firstname,
			'lastname'     => $lastname,
			'email'        => $email,
			'phone_number' => $phoneNumber,
			'ip_address'   => $ipAddress,
			'product_list' => $productList,
			'comment'      => $comment,
			'total'        => $total,

	 	));

		if ($order->save()) 
		{
			return Redirect::route('home')->with('global', 'Order is accepted');
		}
	}

}