<?php

class TurnoverRangesTableSeeder extends Seeder {

	public function run()
	{
		$turnover_ranges = array(
			[
				'lower' => '0',
				'upper' => '0',
			],
			[
				'lower' => '0',
				'upper' => '50000',
			],
			[
				'lower' => '50001',
				'upper' => '75000',
			],
			[
				'lower' => '75001',
				'upper' => '100000',
			],
			[
				'lower' => '100001',
				'upper' => '150000',
			],
			[
				'lower' => '150001',
				'upper' => '200000',
			],
			[
				'lower' => '200001',
				'upper' => '350000',
			],
			[
				'lower' => '350001',
				'upper' => '500000',
			],
			[
				'lower' => '500001',
				'upper' => '750000',
			],
			[
				'lower' => '750001',
				'upper' => '1000000',
			],
			[
				'lower' => '1000001',
				'upper' => '2500000',
			],
			[
				'lower' => '2500001',
				'upper' => '5000000',
			],
			[
				'lower' => '5000001',
				'upper' => '7500000',
			],
			[
				'lower' => '7500001',
				'upper' => '10000000',
			],
			[
				'lower' => '10000001',
				'upper' => '50000000',
			],
			[
				'lower' => '50000001',
				'upper' => '100000000',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('turnover_ranges')->insert($turnover_ranges);
	}

}
