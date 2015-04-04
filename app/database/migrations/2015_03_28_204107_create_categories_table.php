<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// строится по принципу вложенных множеств (Nested Sets)
		
		Schema::create('categories', function($table){

			$table->increments('id'); // идентификатор категории
			$table->string('title', 30); // название категории
			$table->string('url'); // URL категории (ЧПУ)
			
			$table->integer('left_key'); // левый ключ
			$table->integer('right_key'); // правый ключ
			$table->integer('level'); // уровень вложенности
			$table->integer('parent_id'); // идентификатор родителя (для уменьшения количества запросов)

			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
