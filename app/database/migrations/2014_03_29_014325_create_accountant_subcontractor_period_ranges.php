<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantSubcontractorPeriodRanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_subcontractor_period_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned();
			$table->integer('subcontractor_period_range_id')->unsigned();

			$table->foreign('accountant_id', 'aspr_accountant_id_fk')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('subcontractor_period_range_id', 'aspr_subcontraction_period_range_id_fk')->references('id')->on('subcontractor_period_ranges')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_subcontractor_period_ranges');
	}

}
