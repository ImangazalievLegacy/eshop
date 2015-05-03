<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('orders', function($table){

			$table->increments('id'); // идентификатор заказа
			
			$table->string('type'); // тип заказчика (гость/зарегистрированный пользователь)
			$table->integer('owner_id'); // идентификатор пользователя
			$table->integer('address_id'); // идентификатор адреса
			$table->string('firstname', 30); // имя заказчика
			$table->string('lastname', 30); // фамилия заказчика
			$table->string('email', 50); // E-mail заказчика
			$table->string('phone_number', 50); // телефон заказчика
			$table->string('ip_address', 50); // IP-адрес заказчика

			$table->text('product_list'); // список заказанных товаров
			$table->text('comment'); // комментарий к заказу
			$table->integer('total'); // общая цена всех товаров (итого)

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
		Schema::drop('orders');
	}

}
