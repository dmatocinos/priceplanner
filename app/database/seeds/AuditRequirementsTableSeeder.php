<?php

class AuditRequirementsTableSeeder extends Seeder {

	public function run()
	{
		$audit_requirements = array(
			[
				'label' => 'Yes',
				'qty'	=> 1,
				'value' => '2500',
			],
			[
				'label' => 'No',
				'qty'	=> 0,
				'value' => '0',
			],
		);

		// Uncomment the below to run the seeder
		DB::table('audit_requirements')->insert($audit_requirements);
	}

}
