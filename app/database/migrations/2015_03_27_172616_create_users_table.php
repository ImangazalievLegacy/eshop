<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('users', function($table){

			$table->increments('id'); // идентификатор пользователя
			$table->string('username', 30); // никнейм пользователя
			$table->string('email', 50); // E-mail пользователя
			$table->string('password', 128); // хеш пароля пользователя

			$table->string('hash', 128); // код активации
			$table->integer('active'); // флаг верификации E-mail пользователя 
			$table->integer('blocked'); // пользователя (заблокирован/не заблокирован)
			$table->integer('role'); // роль (должность) пользователя (администратор, модератор, обычный пользователь)

			$table->string('remember_token', 128);// токен для функции "Запомнить меня"
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
		Schema::drop('users');
	}

}
