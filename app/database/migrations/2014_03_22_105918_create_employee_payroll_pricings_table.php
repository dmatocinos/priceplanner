<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeePayrollPricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_payroll_pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_period_range_id')->unsigned()->index();
			$table->integer('pricing_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('cascade');
			$table->foreign('employee_period_range_id')->references('id')->on('employee_period_ranges')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_payroll_pricings');
	}

}
