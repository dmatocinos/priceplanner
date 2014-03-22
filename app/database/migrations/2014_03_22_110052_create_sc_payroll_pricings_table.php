<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScPayrollPricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sc_payroll_pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sc_period_range_id')->unsigned()->index();
			$table->integer('pricing_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('sc_period_range_id')->references('id')->on('subcontractor_period_ranges')->onDelete('cascade');
			$table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sc_payroll_pricings');
	}

}
