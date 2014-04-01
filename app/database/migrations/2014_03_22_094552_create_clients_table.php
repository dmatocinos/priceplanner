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
			$table->integer('accountant_id')->unsigned()->index();
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
