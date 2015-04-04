<?php

class CategoryController extends BaseController {

	public function getIndex($url)
	{
		return View::make('themes.default.category.index');
	}

}