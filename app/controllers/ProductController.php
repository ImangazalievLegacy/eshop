<?php

class ProductController extends BaseController {

	public function getIndex()
	{
		App::abort(404);
	}

	public function getShowProduct($productUrl)
	{
		$product = Product::getByUrl($productUrl);

		if ($product == null)
		{
			App::abort(404);
		}

		$product = $product->first();

		return View::make('themes.default.catalog.product.card')->with('product', $product);
	}

	public function postAddProduct()
	{

		$data = Input::all();

		$currencies = Currency::getCodes();

		$currencies = implode(',', $currencies);

		$rules = array(

			'title'          => 'required|max:256|min:10',
			'url'            => 'required|max:512|min:10|unique:products',
			'description'    => 'required|min:10',
			'category_id'    => 'required',
			'price'          => 'required|numeric',
			'old_price'      => 'numeric',
			'article_number' => 'required',
			'currency'       => 'required|in:' . $currencies,

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::route('products.add')
				->withErrors($validator)
				->withInput($data);
		}
		else 
		{
			$title          = Input::get('title');
			$url            = Input::get('url');
			$description    = Input::get('description');
			$categoryId     = Input::get('category_id');
			$price          = Input::get('price');
			$oldPrice       = Input::get('old_price', 0);
			$articleNumber  = Input::get('article_number');
			$currency       = Input::get('currency');

			$product = Product::create(array(

				'title'          => $title,
				'url'            => $url,
				'description'    => $description,
				'category_id'    => $categoryId,
				'price'          => $price,
				'old_price'      => $oldPrice,
				'article_number' => $articleNumber,
				'currency'       => $currency,

			));

			if ($product->save()) 
			{
				return Redirect::route('products.add')->with('global', 'Product added');
			}
		}

	}

}