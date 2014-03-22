<?php

class AccountingTypeTableSeeder extends Seeder {

	public function run()
	{
		$accounting_types = array(
			[
				'name' => 'Manual',
			],
			[
				'name' => 'Computerised',
			]
		);

		DB::table('accounting_types')->insert($accounting_types);

	}

}
