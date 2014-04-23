<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateAccountantTurnoverRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accountant_turnover_ranges', function(Blueprint $table)
		{
			$table->integer('lower')->nullable();
			$table->integer('upper')->nullable();
			$table->dropForeign('accountant_turnover_ranges_turnover_range_id_foreign');
			$table->dropColumn('turnover_range_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accountant_turnover_ranges', function(Blueprint $table)
		{
			
		});
	}

}
