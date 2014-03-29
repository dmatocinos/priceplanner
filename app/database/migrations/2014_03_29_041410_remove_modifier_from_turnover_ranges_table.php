<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveModifierFromTurnoverRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('turnover_ranges', function(Blueprint $table)
		{
			$table->dropColumn('modifier');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('turnover_ranges', function(Blueprint $table)
		{
			$table->double('modifier');
		});
	}

}
