<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantEmployeePeriodRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_employee_period_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned();
			$table->integer('employee_period_range_id')->unsigned();

			$table->foreign('accountant_id', 'aeppr_accountant_id_fk')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('employee_period_range_id', 'aeppr_employee_period_range_id_fk')->references('id')->on('employee_period_ranges')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_employee_period_ranges');
	}

}
