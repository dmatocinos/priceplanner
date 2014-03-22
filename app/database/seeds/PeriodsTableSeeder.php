<?php


class PeriodsTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Weekly',
			],
			[
				'name' => 'Forthnightly',
			],
			[
				'name' => 'Four Weekly',
			],
			[
				'name' => 'Monthly',
			],
			[
				'name' => 'Annually',
			],
		);

		DB::table('periods')->insert($data);
	}

}
