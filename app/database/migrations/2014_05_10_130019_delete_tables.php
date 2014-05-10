<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('accountant_employee_period_ranges');
		Schema::drop('accountant_subcontractor_period_ranges');
		Schema::drop('employee_payroll_pricings');
		Schema::drop('employee_period_ranges');
		Schema::drop('sc_payroll_pricings');
		Schema::drop('subcontractor_period_ranges');
		Schema::drop('ranges');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
