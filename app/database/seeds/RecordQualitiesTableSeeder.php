<?php

class RecordQualitiesTableSeeder extends Seeder {

	public function run()
	{
		$record_qualities = array(
			[
				'name' => 'Non existant',
			],
			[
				'name' => 'Very poor',
			],
			[
				'name' => 'Poor',
			],
			[
				'name' => 'Average',
			],
			[
				'name' => 'Good',
			],
			[
				'name' => 'Very good',
			],
			[
				'name' => 'Excellent',
			],
			[
				'name' => 'Full accounts',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('record_qualities')->insert($record_qualities);

	}

}
