<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPeriodIdToClientPeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_periods', function(Blueprint $table)
		{
			$table->integer('period_id')->unsigned();

			$table->foreign('period_id')
				->references('id')->on('periods')
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
		Schema::table('client_periods', function(Blueprint $table)
		{
			$table->dropForeign('client_periods_period_id_foreign');

			$table->dropColumn('period_id');
		});
	}

}
