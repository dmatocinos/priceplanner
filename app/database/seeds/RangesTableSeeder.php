<?php


class RangesTableSeeder extends Seeder {

	public function run()
	{
		$data = [
			[
				'lower' => 0,
				'upper' => 0
			],
			[
				'lower' => 1,
				'upper' => 1
			],
			[
				'lower' => 2,
				'upper' => 5
			],
			[
				'lower' => 6,
				'upper' => 10
			],
			[
				'lower' => 11,
				'upper' => 19
			],
			[
				'lower' => 20,
				'upper' => 24
			],
			[
				'lower' => 25,
				'upper' => 29
			],
			[
				'lower' => 30,
				'upper' => 34
			],
			[
				'lower' => 35,
				'upper' => 39
			],
			[
				'lower' => 40,
				'upper' => 49
			],
			[
				'lower' => 50,
				'upper' => 50
			],

		];

		DB::table('ranges')->insert($data);
	}

}
