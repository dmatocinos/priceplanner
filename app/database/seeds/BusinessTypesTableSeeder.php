<?php

class BusinessTypesTableSeeder extends Seeder {

	public function run()
	{
		$business_types = array(
			[
				'name' => 'Ltd Co',
			],
			[
				'name' => 'LLP',
			],
			[
				'name' => 'Charity - inc',
			],
			[
				'name' => 'Charity - uninc',
			],
			[
				'name' => 'Club/Association',
			],
			[
				'name' => 'Partnership',
			],
			[
				'name' => 'Sole trader',
			],
			[
				'name' => 'Subcontrator',
			],
			[
				'name' => 'Tax only',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('business_types')->insert($business_types);
	}

}
