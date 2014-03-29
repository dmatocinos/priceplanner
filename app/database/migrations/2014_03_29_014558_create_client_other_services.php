<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientOtherServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_other_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('client_id')->unsigned()->index();
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_other_services');
	}

}
