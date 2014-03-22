<?php

class ModulesTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Virtual FD',
				'value' => '2000',
			],
			[
				'name' => 'Virtual FD pro',
				'value' => '6000',
			],
			[
				'name' => 'Business Module',
				'value' => '2000',
			],
			[
				'name' => 'Personal Module',
				'value' => '3000',
			],
		);

		DB::table('modules')->insert($data);
	}

}
