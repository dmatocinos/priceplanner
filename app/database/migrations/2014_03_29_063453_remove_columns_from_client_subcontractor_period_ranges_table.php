<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveColumnsFromClientSubcontractorPeriodRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_subcontractor_period_ranges', function(Blueprint $table)
		{
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
		Schema::table('client_subcontractor_period_ranges', function(Blueprint $table)
		{
			$table->integer('period_id');
			$table->integer('range_id');
		});
	}

}
