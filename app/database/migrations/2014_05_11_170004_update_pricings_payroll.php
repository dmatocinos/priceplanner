<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePricingsPayroll extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pricings', function(Blueprint $table)
		{
			$table->integer('no_of_subcontractors');	
			$table->integer('subcontractor_pay_run_frequency');	
			$table->integer('employee_pay_run_frequency');	
			$table->dropColumn('payroll_run_frequency');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pricings', function(Blueprint $table)
		{
			
		});
	}

}
