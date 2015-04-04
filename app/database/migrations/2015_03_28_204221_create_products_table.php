<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('products', function($table){

			$table->increments('id'); // идентификатор товара
			$table->string('title', 256); // название товара
			$table->text('description'); // описание товара

			$table->integer('price'); // цена товара
			$table->integer('old_price'); // старая цена товара

			$table->string('url'); // URL товара (ЧПУ)

			$table->string('part_number', 32); // артикул товара
			$table->string('currency', 16); // валюта, в которой указана цена товара

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
		Schema::drop('products');
	}

}
