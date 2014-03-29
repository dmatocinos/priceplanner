<?php

class TaxReturnsTableSeeder extends Seeder {

	public function run()
	{
		$data = array (
			[
				'name' => 'Coporation Tax Return',
			],
			[
				'name' => 'Partnership Tax Return',
			],
			[
				'name' => 'Self-Assessment Return',
			],
		);

		DB::table('tax_returns')->insert($data);
	}
}
