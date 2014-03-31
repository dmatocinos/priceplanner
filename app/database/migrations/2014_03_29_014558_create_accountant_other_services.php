<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantOtherServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_other_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('other_service_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('other_service_id')->references('id')->on('other_services')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_other_services');
	}

}
