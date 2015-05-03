<?php

namespace Shop\Cart;

class Cart {

	protected $sessionKey = 'cart.items';

	public function all()
	{
		return \Session::get($this->sessionKey);
	}

	public function add($product, $count = 1)
	{

		$key = $this->sessionKey . '.' . $product->id;;

		if (\Session::has($key))
		{

			$data = \Session::get($key);

			$data['count'] += $count;

		}
		else
		{

			$data = array(

				'id'             => $product->id,
				'title'          => $product->title,
				'price'          => $product->price,
				'article_number' => $product->article_number,
				'url' => $product->url,
				'count'          => $count,

			);

		}

		\Session::put($key, $data);

	}

	public function delete($id)
	{
		\Session::forget($this->sessionKey . '.' . $id);
	}

	public function clear()
	{
		\Session::forget($this->sessionKey);
	}

	public function has($id)
	{
		return \Session::has($this->sessionKey . '.' . $id);
	}

	public function count()
	{
		return count($this->all());
	}

	public function isEmpty()
	{
		return $this->count() == 0;
	}

	public function getTotal()
	{
		return 10000;
	}

}