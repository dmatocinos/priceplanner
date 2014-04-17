<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAddressColumnsToClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function(Blueprint $table)
		{
			$table->renameColumn('address', 'street_address');
			$table->string('city_address');
			$table->string('state_address');
			$table->string('country_address');
			$table->string('zip_address');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clients', function(Blueprint $table)
		{
			$table->renameColumn('street_address', 'address');
			$table->dropColumn('city_address');
			$table->dropColumn('state_address');
			$table->dropColumn('country_address');
			$table->dropColumn('zip_address');
		});
	}

}
