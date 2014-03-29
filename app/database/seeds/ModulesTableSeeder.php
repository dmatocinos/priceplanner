<?php

class ModulesTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Virtual FD',
			],
			[
				'name' => 'Virtual FD pro',
			],
			[
				'name' => 'Business Module',
			],
			[
				'name' => 'Personal Module',
			],
		);

		DB::table('modules')->insert($data);
	}

}
