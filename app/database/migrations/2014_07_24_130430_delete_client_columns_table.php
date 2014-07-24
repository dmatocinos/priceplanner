<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteClientColumnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function($table) {
			$table->dropColumn(array(
				'client_name',
				'business_name',
				'street_address',
				'city_address',
				'state_address',
				'country_address',
				'zip_address',
				'period_start_date', 
				'period_end_date', 
			));	
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
