<?php

class RecordQualitiesTableSeeder extends Seeder {

	public function run()
	{
		$record_qualities = array(
			[
				'name' => 'Non existant',
				'percentage' => '40',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Very poor',
				'percentage' => '30',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Poor',
				'percentage' => '20',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Average',
				'percentage' => '0',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Good',
				'percentage' => '-5',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Very good',
				'percentage' => '-15',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Excellent',
				'percentage' => '-20',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Full accounts',
				'percentage' => '-25',
				'accounting_type_id'	=> '1'	
			],
			[
				'name' => 'Non existant',
				'percentage' => '30',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Very poor',
				'percentage' => '20',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Poor',
				'percentage' => '10',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Average',
				'percentage' => '0',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Good',
				'percentage' => '-10',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Very good',
				'percentage' => '-20',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Excellent',
				'percentage' => '-25',
				'accounting_type_id'	=> '2'	
			],
			[
				'name' => 'Full accounts',
				'percentage' => '-30',
				'accounting_type_id'	=> '2'	
			],
		);

		// Uncomment the below to run the seeder
		DB::table('record_qualities')->insert($record_qualities);

	}

}
