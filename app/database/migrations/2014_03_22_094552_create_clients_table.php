<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('client_name');
			$table->string('business_name');
			$table->string('address');
			$table->date('period_start_date');
			$table->date('period_end_date');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('business_type_id')->unsigned()->index();
			$table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
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
		Schema::drop('clients');
	}

}
