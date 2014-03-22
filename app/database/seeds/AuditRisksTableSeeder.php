<?php

class AuditRisksTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Low',
				'percentage' => '100',
			],
			[
				'name' => 'Medium',
				'percentage' => '150',
			],
			[
				'name' => 'High',
				'percentage' => '200',
			],
		);

		DB::table('audit_risks')->insert($data);
	}

}
