<?php

class OtherServicesTableSeeder extends Seeder {

	public function run()
	{
		$data = array(
			[
				'name' => 'Business Valuation',
				'value' => '220',
				'description' => 'We will carry out a commercial valuation of your business using our BizValution software and produce a full report of our calculations that is suitable for your requirements.'
			],
			[
				'name' => 'Incorporation PLanner',
				'value' => '60',
				'description' => 'We will produce a report showing the benefits of becoming incorporated and the tax savings.  We are able to set up your company and register it to Companies House should you require it'
			],
			[
				'name' => 'Personal Balance Sheet, IHT Health Check and Investment Review',
				'value' => '80',
				'description' => 'We will carry out a full review of your and your partner’s personal assets and liabilities both current and future. The review will identify your family’s exposure to future Inheritance Tax liability and recommend a course of action to minimise your exposure to Inheritance Tax in a clear and precise report so you can take appropriate action. Any investments you hold, we will put forward recommendations on the best investment strategy using active fund management in order for you to get the best returns.'
			],
			[
				'name' => 'P11D forms',
				'value' => '30',
				'description' => 'Description of service availabe for final report'
			],
			[
				'name' => 'Fee Protection Insurance',
				'value' => '75',
				'description' => 'Description of service availabe for final report'
			],
			[
				'name' => 'Business Planning',
				'value' => '125',
				'description' => 'Description of service availabe for final report'
			],
			[
				'name' => 'Cash Flow Forecast',
				'value' => '300',
				'description' => 'Description of service availabe for final report'
			],
			[
				'name' => 'Management Account',
				'value' => '150',
				'description' => 'Description of service availabe for final report'
			],
		);

		DB::table('other_services')->insert($data);
	
	}

}
