<?php

class RecordQualitiesTableSeeder extends Seeder {

	public function run()
	{
		$record_qualities = array(
			[
				'name' => 'Non existant',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Very poor',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Poor',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Average',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Good',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Very good',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Excellent',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Full accounts',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Non existant',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Very poor',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Poor',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Average',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Good',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Very good',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Excellent',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Full accounts',
				'accounting_type_id'	=> '2'	
			],
		);

		// Uncomment the below to run the seeder
		DB::table('record_qualities')->insert($record_qualities);

	}

}
