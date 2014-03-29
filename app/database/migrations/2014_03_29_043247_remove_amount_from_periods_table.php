<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveAmountFromPeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('periods', function(Blueprint $table)
		{
			$table->dropColumn('amount');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('periods', function(Blueprint $table)
		{
			$table->double('amount');
		});
	}

}
