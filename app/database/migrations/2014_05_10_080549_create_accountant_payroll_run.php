<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantPayrollRun extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_payroll_runs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('accountant_turnover_range_id')->unsigned()->index();;
			$table->integer('accountant_id')->unsigned()->index();
			$table->double('value');
			$table->timestamps();
			$table->foreign('accountant_turnover_range_id')->references('id')->on('accountant_turnover_ranges')->onDelete('cascade');
			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_payroll_run');
	}

}
