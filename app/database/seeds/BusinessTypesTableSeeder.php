<?php

class BusinessTypesTableSeeder extends Seeder {

	public function run()
	{
		$business_types = array(
			[
				'name' => 'Ltd Co',
				'base_fee' => '1500',
			],
			[
				'name' => 'LLP',
				'base_fee' => '1200',
			],
			[
				'name' => 'Charity - inc',
				'base_fee' => '1200',
			],
			[
				'name' => 'Charity - uninc',
				'base_fee' => '1000',
			],
			[
				'name' => 'Club/Association',
				'base_fee' => '1200',
			],
			[
				'name' => 'Partnership',
				'base_fee' => '800',
			],
			[
				'name' => 'Sole trader',
				'base_fee' => '400',
			],
			[
				'name' => 'Subcontrator',
				'base_fee' => '250',
			],
			[
				'name' => 'Tax only',
				'base_fee' => '200',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('business_types')->insert($business_types);
	}

}
