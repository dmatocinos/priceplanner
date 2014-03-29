<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientEmployeePeriodRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_employee_period_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('client_id')->unsigned()->index();
			$table->integer('period_id')->unsigned()->index();
			$table->integer('range_id')->unsigned()->index();
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
			$table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
			$table->foreign('range_id')->references('id')->on('ranges')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_employee_period_ranges');
	}

}
