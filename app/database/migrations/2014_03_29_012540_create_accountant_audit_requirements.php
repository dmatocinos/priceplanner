<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantAuditRequirements extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_audit_requirements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('audit_requirement_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('audit_requirement_id')->references('id')->on('audit_requirements')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_audit_requirements');
	}

}
