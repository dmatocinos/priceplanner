<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantTurnoverRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_turnover_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('modifier');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('turnover_range_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('turnover_range_id')->references('id')->on('turnover_ranges')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_turnover_ranges');
	}

}
