<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeePeriodRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_period_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('value');
			$table->timestamps();

			$table->integer('range_id')->unsigned()->index();
			$table->integer('period_id')->unsigned()->index();

			$table->foreign('range_id')->references('id')->on('ranges')->onDelete('cascade');
			$table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_period_ranges');
	}

}
