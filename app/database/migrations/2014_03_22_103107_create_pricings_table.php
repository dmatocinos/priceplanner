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
			$table->integer('client_id')->unsigned()->index();
			$table->integer('business_type_id')->unsigned()->index();
			$table->integer('accounting_type_id')->unsigned()->index();
			$table->integer('record_quality_id')->unsigned()->index();
			$table->integer('turnovers');
			$table->integer('audit_requirement_id')->unsigned()->index();
			$table->integer('audit_risk_id')->unsigned()->index();
			$table->integer('corporate_tax_return');
			$table->integer('partnership_tax_return');
			$table->integer('self_assessment_tax_return');
			$table->integer('vat_return');
			$table->integer('bookkeeping_hours');
			$table->integer('bookkeeping_days');
			$table->double('bookkeeping_hour_val');
			$table->double('bookkeeping_day_val');
			$table->double('discount');

			/* foreign keys */
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
			$table->foreign('record_quality_id')->references('id')->on('record_qualities')->onDelete('cascade');
			$table->foreign('audit_requirement_id')->references('id')->on('audit_requirements')->onDelete('cascade');
			$table->foreign('audit_risk_id')->references('id')->on('audit_risks')->onDelete('cascade');
			$table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');
			$table->foreign('accounting_type_id')->references('id')->on('accounting_types')->onDelete('cascade');

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
