<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSubcontractorPeriodRangeIdToClientSubcontractorPeriodRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_subcontractor_period_ranges', function(Blueprint $table)
		{
			$table->integer('subcontractor_period_range_id')->unsigned();

			/*
			 * IDENTIFIER name too long
			$table->foreign('subcontractor_period_range_id')
				->references('id')->on('subcontractor_period_ranges')
				->onDelete('cascade');
			 */
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
			//$table->dropForeign('client_subcontractor_period_ranges_subcontractor_period_range_id_foreign');

			$table->dropColumn('subcontractor_period_range_id');
		});
	}

}
