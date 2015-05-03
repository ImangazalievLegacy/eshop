<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtendedUserInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('extended_user_information', function($table){

			$table->increments('id'); // идентификатор адреса
			$table->integer('owner_id'); // идентификатор пользователя, которому принадлежат данные
			
			$table->integer('default_address_id'); // идентификатор адреса по умолчанию

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
		Schema::drop('extended_user_information');
	}

}
