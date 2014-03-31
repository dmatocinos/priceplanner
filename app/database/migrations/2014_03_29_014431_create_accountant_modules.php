<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantModules extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_modules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('module_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_modules');
	}

}
