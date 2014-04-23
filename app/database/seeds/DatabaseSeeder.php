<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('AccountingTypeTableSeeder');
		$this->call('AuditRequirementsTableSeeder');
		$this->call('AuditRisksTableSeeder');
		$this->call('TaxReturnsTableSeeder');
		$this->call('BusinessTypesTableSeeder');
		$this->call('ModulesTableSeeder');
		$this->call('OtherServicesTableSeeder');
		$this->call('PeriodsTableSeeder');
		$this->call('RangesTableSeeder');
		$this->call('RecordQualitiesTableSeeder');
		$this->call('EmployeePeriodRangesTableSeeder');
		$this->call('SubcontractorPeriodRangesTableSeeder');
	}

}
