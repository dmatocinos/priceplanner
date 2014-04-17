<?php


class PeriodsTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Weekly',
				'amount' => 52,
			],
			[
				'name' => 'Fortnightly',
				'amount' => 26,
			],
			[
				'name' => 'Four-Weekly',
				'amount' => 13,
			],
			[
				'name' => 'Monthly',
				'amount' => 12,
			],
			[
				'name' => 'Annually',
				'amount' => 1,
			],
		);

		DB::table('periods')->insert($data);
	}

}
