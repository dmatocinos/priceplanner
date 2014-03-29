<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTurnoverRangeIdToClientTurnoverRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_turnover_ranges', function(Blueprint $table)
		{
			$table->integer('turnover_range_id')->unsigned();
			$table->foreign('turnover_range_id')
				->references('id')->on('turnover_ranges')
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
		Schema::table('client_turnover_ranges', function(Blueprint $table)
		{
			$table->dropForeign('client_turnover_ranges_turnover_range_id_foreign');
			$table->dropColumn('turnover_range_id');
		});
	}

}
