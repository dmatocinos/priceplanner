<?php

class SubcontractorPeriodRangesTableSeeder extends Seeder {

	public function run()
	{
		$periods = [
			'weekly' => 1,
			'monthly' => 4,
		];

		$ranges = [
			'0' => 1,
			'1' => 2,
			'2-5' => 3,
			'6-10' => 4,
			'11-19' => 5,
			'20-24' => 6,
			'25-29' => 7,
			'30-34' => 8,
			'35-39' => 9,
			'40-49' => 10,			
			'50+' => 11
		];

		$values = [
			'weekly' => [ 
				'0' => 0,
				'1' => 25,	
				'2-5' => 35,
				'6-10' => 45,	
				'11-19' => 55,
				'20-24' => 65,
				'25-29' => 75,
				'30-34' => 85,
				'35-39' => 100,
				'40-49' => 125,
				'50+' => 0,
			],
			'monthly' => [ 
				'0' => 0,
				'1' => 35,	
				'2-5' => 45,
				'6-10' => 55,	
				'11-19' => 65,
				'20-24' => 75,
				'25-29' => 85,
				'30-34' => 100,
				'35-39' => 125,
				'40-49' => 150,
				'50+' => 0,
			],
		];
		
		$data = [];

		foreach ($values as $pid => $pval) {
			foreach ($pval as $rid => $val) {
				$data[] = [
					'range_id' => $ranges[$rid],
					'period_id' => $periods[$pid],
				];
			}
		}

		DB::table('subcontractor_period_ranges')->insert($data);
	}

}
