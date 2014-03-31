<?php

class AppPricingTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('app_pricings')->truncate();

		$pricing = array(
			array('membership_level' => 'Pay as you go', 'discount' => '.00'),
			array('membership_level' => 'Tax Club', 'discount' => '.00'),
			array('membership_level' => 'Elite Member', 'discount' => '1.00'),
		);

		// Uncomment the below to run the seeder
		DB::table('app_pricings')->insert($pricing);
	}

}
