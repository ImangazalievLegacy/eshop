<?php

class CartController extends BaseController {

	public function getIndex()
	{
		$items = Cart::all();

		return View::make('themes.default.cart.index')->with('items', $items);
	}

	public function postAddProduct()
	{
		$data = Input::all();

		$rules = array(

			'id' => 'required|numeric',

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::back()->with('global', 'Error!');
		}

		$id = Input::get('id');

		$product = Product::find($id);

		Cart::add($product);

		return Redirect::back();
	}

	public function postDeleteProduct()
	{
		$data = Input::all();

		$rules = array(

			'id' => 'required|numeric',

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::back()->with('global', 'Error!');
		}

		$id = Input::get('id');

		Cart::delete($id);

		return Redirect::back();
	}

}


