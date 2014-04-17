<?php

class BusinessTypesTableSeeder extends Seeder {

	public function run()
	{
		$business_types = array(
			[
				'name' => 'Limited Company',
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
				'name' => 'Sole Trader',
			],
			[
				'name' => 'Subcontrator',
			],
			[
				'name' => 'Tax Only',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('business_types')->insert($business_types);
	}

}
