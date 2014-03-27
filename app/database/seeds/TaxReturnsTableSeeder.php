<?php

class TaxReturnsTableSeeder extends Seeder {

	public function run()
	{
		$data = array (
			[
				'name' => 'Coporation Tax Return',
				'value' => '100',
			],
			[
				'name' => 'Partnership Tax Return',
				'value' => '120',
			],
			[
				'name' => 'Self-Assessment Return',
				'value' => '150',
			],
		);

		DB::table('tax_returns')->insert($data);
	}
}
