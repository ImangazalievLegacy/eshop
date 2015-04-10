<?php

class CatalogController extends BaseController {

	public function getIndex()
	{
		$products = Product::all();

		return View::make('themes.default.catalog.index')->with('products', $products);
	}

	public function getCategoryIndex($url)
	{

		$category = Category::getByPath($url);

		if ($category == null)
		{
			App::abort(404);
		}
		else
		{

			$categoryId = $category->id;

			if ($category->hasChild())
			{
				$subcategories = $category->getSubcategories();

				$categoryIds = array();

				foreach ($subcategories as $subcategory) {
					
					$categoryIds[] = $subcategory->id;

				}

				$products = Product::getByCategory($categoryIds);
			}
			else
			{
				$products = Product::getByCategory($categoryId);
			}
		}

		return View::make('themes.default.catalog.category')->with('products', $products);
	}

}