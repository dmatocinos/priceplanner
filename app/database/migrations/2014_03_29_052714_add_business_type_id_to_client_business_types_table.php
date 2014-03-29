<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBusinessTypeIdToClientBusinessTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_business_types', function(Blueprint $table)
		{
			$table->integer('business_type_id')->unsigned();
			$table->foreign('business_type_id')
				->references('id')->on('business_types')
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
		Schema::table('client_business_types', function(Blueprint $table)
		{
			$table->dropForeign('client_business_types_business_type_id_foreign');
			$table->dropColumn('business_type_id');
		});
	}

}
