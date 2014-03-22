<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('client_id')->unsigned()->index();
			$table->integer('record_quality_id')->unsigned()->index();
			$table->integer('turnover_range_id')->unsigned()->index();
			$table->integer('audit_requirement_id')->unsigned()->index();
			$table->integer('audit_risk_id')->unsigned()->index();
			$table->integer('vat_return');
			$table->integer('bookkeeping_hours');
			$table->integer('bookkeeping_days');
			$table->double('bookkeeping_hour_val');
			$table->double('bookkeeping_day_val');

			/* foreign keys */
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
			$table->foreign('record_quality_id')->references('id')->on('record_qualities')->onDelete('cascade');
			$table->foreign('turnover_range_id')->references('id')->on('turnover_ranges')->onDelete('cascade');
			$table->foreign('audit_requirement_id')->references('id')->on('audit_requirements')->onDelete('cascade');
			$table->foreign('audit_risk_id')->references('id')->on('audit_risks')->onDelete('cascade');

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
		Schema::drop('pricings');
	}

}
