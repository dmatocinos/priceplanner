<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientAuditRisksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_audit_risks', function(Blueprint $table)
		{
			$table->integer('audit_risk_id')->unsigned();
			$table->foreign('audit_risk_id')
				->references('id')->on('audit_risks')
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
		Schema::table('client_audit_risks', function(Blueprint $table)
		{
			$table->dropForeign('client_audit_risks_audit_risk_id_foreign');

			$table->dropColumn('audit_risk_id');
		});
	}

}
