<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOtherServiceIdToClientOtherServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_other_services', function(Blueprint $table)
		{
			$table->integer('other_service_id')->unsigned();

			$table->foreign('other_service_id')
				->references('id')->on('other_services')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_other_services', function(Blueprint $table)
		{
			$table->dropForeign('client_other_services_other_service_id_foreign');

			$table->dropColumn('other_service_id');
		});
	}

}
