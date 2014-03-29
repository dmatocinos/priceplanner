<?php

class AuditRisksTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Low',
			],
			[
				'name' => 'Medium',
			],
			[
				'name' => 'High',
			],
		);

		DB::table('audit_risks')->insert($data);
	}

}
