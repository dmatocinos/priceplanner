<?php

class RecordQualitiesTableSeeder extends Seeder {

	public function run()
	{
		$record_qualities = array(
			[
				'name' => 'Non-Existent',
			],
			[
				'name' => 'Very Poor',
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
				'name' => 'Very Good',
			],
			[
				'name' => 'Excellent',
			],
			[
				'name' => 'Full Accounts',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('record_qualities')->insert($record_qualities);

	}

}
