<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePayrollTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accountant_pay_runs', function(Blueprint $table)
		{
			$table->string('type');	
		});

		Schema::table('accountant_payroll_runs', function(Blueprint $table)
		{
			$table->string('type');	
		});
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
