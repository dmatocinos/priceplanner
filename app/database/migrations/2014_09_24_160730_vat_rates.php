<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VatRates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pricings', function(Blueprint $table)
		{
	//		$table->double('vat_rate_type');
		
		});

		Schema::table('accountant_vat_returns', function(Blueprint $table)
		{
			$table->double('std_rate');
			$table->double('flat_rate');
		
		});
		$data = array(
			[
				'name' => 'Annual Return Submission',
				'description' => 'Description of service availabe for final report'
			],
		);
		DB::table('other_services')->insert($data);
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
