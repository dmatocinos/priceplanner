<?php

class TurnoverRangesTableSeeder extends Seeder {

	public function run()
	{
		$turnover_ranges = array(
			[
				'lower' => '0',
				'upper' => '0',
				'modifier' => '0',
			],
			[
				'lower' => '0',
				'upper' => '50000',
				'modifier' => '0',
			],
			[
				'lower' => '50001',
				'upper' => '75000',
				'modifier' => '0',
			],
			[
				'lower' => '75001',
				'upper' => '100000',
				'modifier' => '25',
			],
			[
				'lower' => '100001',
				'upper' => '150000',
				'modifier' => '25',
			],
			[
				'lower' => '150001',
				'upper' => '200000',
				'modifier' => '50',
			],
			[
				'lower' => '200001',
				'upper' => '350000',
				'modifier' => '75',
			],
			[
				'lower' => '350001',
				'upper' => '500000',
				'modifier' => '100',
			],
			[
				'lower' => '500001',
				'upper' => '750000',
				'modifier' => '125',
			],
			[
				'lower' => '750001',
				'upper' => '1000000',
				'modifier' => '150',
			],
			[
				'lower' => '1000001',
				'upper' => '2500000',
				'modifier' => '200',
			],
			[
				'lower' => '2500001',
				'upper' => '5000000',
				'modifier' => '200',
			],
			[
				'lower' => '5000001',
				'upper' => '7500000',
				'modifier' => '300',
			],
			[
				'lower' => '7500001',
				'upper' => '10000000',
				'modifier' => '400',
			],
			[
				'lower' => '10000001',
				'upper' => '50000000',
				'modifier' => '500',
			],
			[
				'lower' => '50000001',
				'upper' => '100000000',
				'modifier' => '500',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('turnover_ranges')->insert($turnover_ranges);
	}

}
