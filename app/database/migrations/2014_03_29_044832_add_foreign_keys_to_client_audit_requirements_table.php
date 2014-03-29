<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientAuditRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_audit_requirements', function(Blueprint $table)
		{
			$table->integer('audit_requirement_id')->unsigned();

			$table->foreign('audit_requirement_id')
				->references('id')->on('audit_requirements')
				->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_audit_requirements', function(Blueprint $table)
		{
			$table->dropForeign('client_audit_requirements_audit_requirement_id_foreign');

			$table->dropColumn('audit_requirement_id');
		});
	}

}
