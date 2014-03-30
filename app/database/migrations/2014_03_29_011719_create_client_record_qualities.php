<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientRecordQualities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_record_qualities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('percentage');
			$table->integer('accounting_type_id')->unsigned()->index();
			$table->integer('client_id')->unsigned()->index();
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
			$table->foreign('accounting_type_id')->references('id')->on('accounting_types')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_record_qualities');
	}

}
