<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEmployeePeriodRangeIdToClientEmployeePeriodRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_employee_period_ranges', function(Blueprint $table)
		{
			$table->integer('employee_period_range_id')->unsigned();

			$table->foreign('employee_period_range_id')
				->references('id')->on('employee_period_ranges')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_employee_period_ranges', function(Blueprint $table)
		{
			$table->dropForeign('client_employee_period_ranges_employee_period_range_id_foreign');

			$table->dropColumn('employee_period_range_id');
		});
	}

}
