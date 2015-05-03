<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('title', 'url', 'left_key', 'right_key', 'level', 'parent_id');

	public static function getAll()
	{
		return Category::allNodes();
	}

	public static function getByPath($path, $delimiter = '/')
	{	
		$categories = Category::getAll();

		$segments = explode($delimiter, $path);

		$level = 0;

		$result = null;

		$categoriesNum = count($categories);

		for ($i=1; $i < $categoriesNum; $i++) { 

		 	$category = $categories[$i];

			if ($category->level == $level+1)
			{

				if ($category->url == $segments[$level])
				{
					$level++;

					if ($category->level == count($segments))
					{
						$result = $category;
						break;
					}
				}

			}

		}

		return $result;
	}

	public static function getByRange($leftKey, $rightKey)
	{
		return Category::orderBy('left_key')->where('left_key', '>=', $leftKey)->where('right_key', '<=', $rightKey)->get();
	}

	public function getSubcategories()
	{
		return $this->childNodes();
	}

	public function addSubcategory($title, $url)
	{
		$params = array('title' => $title, 'url' => $url);

		return $this->addChild($params);
	}

	public static function allNodes()
	{
		return Category::orderBy('left_key')->get();
	}

	public function deleteNode()
	{
		// удаление узла с потомками
		Category::where('left_key', '>=', $this->left_key)->where('right_key', '<=', $this->right_key)->delete();

		$amount = $this->right_key - $this->left_key + 1;

		// обновление родительской ветки
		Category::where('left_key', '<', $this->left_key)->where('right_key', '>', $this->right_key)->decrement('right_key', $amount);
				
		// обновление последующих узлов
		Category::where('left_key', '>', $this->right_key)->decrement('left_key', $amount);
		Category::where('left_key', '>', $this->right_key)->decrement('right_key', $amount);

	}

	public function addChild($extra)
	{
		// обновляем ключи существующего дерева, узлы стоящие за родительским узлом
		$sql = "UPDATE $this->table SET left_key = left_key + 2, right_key = right_key + 2 WHERE left_key > ?";

		$params = array($this->right_key);

		DB::update($sql, $params);

		$params = array($this->right_key, $this->right_key);

		// обновляем родительскую ветку
		$sql = "UPDATE $this->table SET right_key = right_key + 2 WHERE right_key >= ? AND left_key < ?";

		DB::update($sql, $params);

		$params = array('left_key' => $this->right_key, 'right_key' => $this->right_key+1, 'level' => $this->level+1);

		$params = array_merge($params, $extra);

		// добавляем новый узел
		Category::create($params);
	}

	public function hasChild()
	{
		// если у узла нет потомков, значение его правого ключа будет больше значения левого на единицу
		return (( $this->right_key - $this->left_key ) > 1);
	}

	public function childNodes()
	{
		return Category::orderBy('left_key')->where('left_key', '>=', $this->left_key)->where('right_key', '<=', $this->right_key)->get();
	}

	public function parentNode()
	{
		return Category::orderBy('left_key')->where('left_key', '<=', $this->left_key)->where('right_key', '>=', $this->right_key)->where('level', '=', $this->level+1)->get();
	}

	public function parentNodes()
	{
		return Category::orderBy('left_key')->where('left_key', '<=', $this->left_key)->where('right_key', '>=', $this->right_key)->get();
	}

	public function getBranch()
	{
		return Category::orderBy('left_key')->where('right_key', '>', $this->left_key)->where('left_key', '<', $this->right_key)->get();
	}

	public function childrenCount()
	{
		return ($this->right_key - $this->left_key - 1)/2;
	}

}
