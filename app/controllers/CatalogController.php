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

	public function postAddCategory()
	{

		$data = Input::all();

		$rules = array(

			'title'     => 'required|max:256|min:5',
			'url'       => 'required|max:512|min:5|unique:categories',
			'parent_id' => 'required',

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::route('category.add')
				->withErrors($validator)
				->withInput($data);
		}
		else 
		{
			$title    = Input::get('title');
			$url      = Input::get('url');
			$parentId = Input::get('parent_id');

			$parentCategory = Category::find($parentId);

			$parentCategory->addChild(array(

				'title'     => $title,
				'url'       => $url,


			));

			dd($parentCategory->toArray());

			return Redirect::route('category.add')->with('global', 'Category added');
		}

	}

}