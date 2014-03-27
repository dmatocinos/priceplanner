<?php


class RangesTableSeeder extends Seeder {

	public function run()
	{
		$data = [
			[
				'lower' => 0,
				'upper' => 0,
				'range' => '0'
			],
			[
				'lower' => 1,
				'upper' => 1,
				'range' => '1'
			],
			[
				'lower' => 2,
				'upper' => 5,
				'range' => '2-5'
			],
			[
				'lower' => 6,
				'upper' => 10,
				'range' => '6-10',
			],
			[
				'lower' => 11,
				'upper' => 19,
				'range' => '11-19',
			],
			[
				'lower' => 20,
				'upper' => 24,
				'range' => '20-24',
			],
			[
				'lower' => 25,
				'upper' => 29,
				'range' => '25-29',
			],
			[
				'lower' => 30,
				'upper' => 34,
				'range' => '30-34',
			],
			[
				'lower' => 35,
				'upper' => 39,
				'range' => '35-39',
			],
			[
				'lower' => 40,
				'upper' => 49,
				'range' => '40-49',
			],
			[
				'lower' => 50,
				'upper' => 50,
				'range' => '50+',
			],

		];

		DB::table('ranges')->insert($data);
	}

}
