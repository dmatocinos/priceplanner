<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantAuditRisks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_audit_risks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('percentage');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('audit_risk_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('audit_risk_id')->references('id')->on('audit_risks')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_audit_risks');
	}

}
