<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveBaseFeeFromBusinessTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_types', function(Blueprint $table) {
			$table->dropColumn('base_fee');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_types', function(Blueprint $table) {
			$table->integer('base_fee');
		});
	}

}
