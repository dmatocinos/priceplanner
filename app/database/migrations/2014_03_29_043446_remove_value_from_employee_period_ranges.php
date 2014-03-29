<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveValueFromEmployeePeriodRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employee_period_ranges', function(Blueprint $table)
		{
			$table->dropColumn('value');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employee_period_ranges', function(Blueprint $table)
		{
			$table->double('value');
		});
	}

}
