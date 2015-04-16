<?php

class AdminController extends BaseController {

	public function getIndex()
	{
		return View::make('themes.default.admin.index');
	}

	public static function isAdmin()
	{
		return Auth::user()->role == 1; // 1 - admin
	}

	public static function getProductsIndex()
	{
		
	}

	public function getAddProduct()
	{
		return View::make('themes.default.admin.catalog.product.add');
	}

	public function getAddCategory()
	{
		return View::make('themes.default.admin.catalog.category.add');
	}

}