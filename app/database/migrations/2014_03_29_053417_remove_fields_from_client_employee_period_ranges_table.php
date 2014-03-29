<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveFieldsFromClientEmployeePeriodRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_employee_period_ranges', function(Blueprint $table)
		{
			$table->dropForeign('client_employee_period_ranges_period_id_foreign');
			$table->dropForeign('client_employee_period_ranges_range_id_foreign');

			$table->dropColumn('period_id');
			$table->dropColumn('range_id');
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
			$table->integer('period_id')->unsigned();
			$table->integer('range_id')->unsigned();

			$table->foreign('period_id')
				->references('id')->on('employee_period_ranges')
				->onDelete('cascade');
			$table->foreign('range_id')
				->references('id')->on('employee_period_ranges')
				->onDelete('cascade');
		});
	}

}
