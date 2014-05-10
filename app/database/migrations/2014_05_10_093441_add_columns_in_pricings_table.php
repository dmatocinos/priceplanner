<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsInPricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pricings', function(Blueprint $table)
		{
			$table->integer('no_of_employees');
			$table->integer('payroll_run_frequency');
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
			$table->dropColumn('no_of_employees');
			$table->dropColumn('payroll_run_frequency');
		});
	}

}
