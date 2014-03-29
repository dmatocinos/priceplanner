<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientSubcontractorPeriodRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_subcontractor_period_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('client_id');
			$table->integer('period_id');
			$table->integer('range_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_subcontractor_period_ranges');
	}

}
