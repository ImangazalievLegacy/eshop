<?php

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('title', 'description', 'price', 'old_price', 'url', 'category_id', 'article_number', 'currency');

	public static function getByCategory($id)
	{
		if (is_array($id))
		{
			return Product::whereIn('category_id', $id)->get();
		}
		else
		{
			return Product::where('category_id', '=', $id)->get();
		}
	}

	public static function getByUrl($url)
	{
		return Product::where('url', '=', $url)->get();
	}

}
