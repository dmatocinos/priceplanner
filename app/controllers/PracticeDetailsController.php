<?php

class PracticeDetailsController extends BaseController 
{
	protected $current_tab;
	
	public function __construct() 
	{
		parent::__construct();
		
		View::share('practice_detail_tabs', array(
			'setup' => 'Setup',
			'businesstypes' => 'Types of Business',
			'ranges' => 'Turnover Ranges',
			'qualities' => 'Record Qualities',
			'audit' => 'Audit',
			'taxes' => 'Taxes',
			'bookkeeping' => 'Bookkeeping',
			'payrolls' => 'Payroll',
			'services' => 'Modules & Services'
		));
		
		View::share('practice_detail_current_tab', $this->current_tab);
	}

	public function getDefaultValues()
	{
		return [
			'business_types' => [
				1 => 1500,
				2 => 1200,
				3 => 1200,
				4 => 1000,
				5 => 1200,
				6 => 800,
				7 => 400,
				8 => 250,
				9 => 200
			],
			'turnover_ranges' => [
				['lower' => 0, 'upper' => 0, 'modifier' => 0],
				['lower' => 0, 'upper' => 75000, 'modifier' => 0],
				['lower' => 75001, 'upper' => 100000, 'modifier' => 25],
				['lower' => 100001, 'upper' => 150000, 'modifier' => 25],
				['lower' => 150001, 'upper' => 200000, 'modifier' => 50],
				['lower' => 200001, 'upper' => 350000, 'modifier' => 75],
				['lower' => 350001, 'upper' => 500000, 'modifier' => 100],
				['lower' => 500001, 'upper' => 750000, 'modifier' => 125],
				['lower' => 750001, 'upper' => 1000000, 'modifier' => 150],
				['lower' => 1000001, 'upper' => 2500000, 'modifier' => 200],
				['lower' => 2500001, 'upper' => 5000000, 'modifier' => 200],
				['lower' => 5000001, 'upper' => 7500000, 'modifier' => 300],
				['lower' => 7500001, 'upper' => 10000000, 'modifier' => 400],
				['lower' => 10000001, 'upper' => 50000000, 'modifier' => 500],
				['lower' => 50000001, 'upper' => 100000000, 'modifier' => 500],
			],
			'accounting_types' => [
				'Non-Existent' => [1 => 40, 2 => 30],
				'Very Poor' => [1 => 30, 2 => 20],
				'Poor' => [1 => 20, 2 => 10],
				'Average' => [1 => 0, 2 => 0],
				'Good' => [1 => -5, 2 => -10],
				'Very Good' => [1 => -15, 2 => -20],
				'Excellent' => [1 => -20, 2 => -25],
				'Full Accounts' => [1 => -25, 2 => -30],
			],
			'audit_requirement' => 2500,
			'audit_risk' => [
				'low' => 100,
				'medium' => 150,
				'high' => 200,	
			],
			'tax_returns' => [
				'Corporation Tax Return' => 100,
				'Partnership Tax Return' => 120,
				'Self-Assessment Return' => 150,
			],
			'vat_returns' => [
				'std_rate' => 100,
				'flat_rate' => 50
			],
			'bookkeeping' => [
				'hour_val' => 30,
				'day_val' => 100
			],
			'payroll' => [
				'charge_per_pay_run' => 25,
				'processing_charge' => 5
			],
			'modules' => [
				'Virtual FD' => 2000,
				'Virtual FD pro' => 6000,
				'Business Module' => 2000,
				'Personal Module' => 3000,
			],
			'other_services' => [
				'Business Valuation' => 220,
				'Incorporation Planner' => 60,
				'Personal Balance Sheet, IHT Health Check and Investment Review' => 80,
				'P11D forms' => 30,
				'Fee Protection Insurance' => 75,
				'Business Planning' => 125,
				'Cash Flow Forecast' => 301,
				'Management Account' => 150,
				'Annual Return Submission' => 50
			],
		];		
	}

	public function saveDefaults($accountant)
	{
		$defaults = $this->getDefaultValues();

		// save business types
		foreach ($defaults['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant->id,
				'business_type_id' => $id
			];

			$model = new AccountantBusinessType;
			$model->create($data);
		} 

		// save turnoiver ranges
		foreach ($defaults['turnover_ranges'] as $data) {
			$data['accountant_id'] = $accountant->id;
			$model = new AccountantTurnoverRange;
			$model->create($data);
		}
		
		// save record qualities
		foreach ($defaults['accounting_types'] as $name => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'accountant_id' => $accountant->id,
					'record_quality_id' => RecordQuality::getId($name),
					'accounting_type_id' => $id,
					'percentage' => $val
				];

				$model = new AccountantRecordQuality;
				$model->create($data);
			}
		}

		// saving client audit_requirements
		$audit_requirements = [1 => $defaults['audit_requirement'], 2 => 0];
		foreach ($audit_requirements as $id => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant->id,
				'audit_requirement_id' => $id
			];
			$model = new AccountantAuditRequirement;
			$model->create($data);
		}
		
		// saving client audit_risks
		foreach ($defaults['audit_risk'] as $name => $val) {
			$data = [
				'percentage' => $val,
				'accountant_id' => $accountant->id,
				'audit_risk_id' => AuditRisk::getId($name)
			];
			$model = new AccountantAuditRisk;
			$model->create($data);
		}
		
		// saving tax returns
		foreach ($defaults['tax_returns'] as $name => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant->id,
				'tax_return_id' => TaxReturn::getId($name)
			];
			$model = new AccountantTaxReturn;
			$model->create($data);
		}

		// saving vat returns
		$defaults['vat_returns']['accountant_id'] = $accountant->id;
		AccountantVatReturn::create($defaults['vat_returns']);

		// saving bookkeeping
		$defaults['bookkeeping']['accountant_id'] = $accountant->id;
		AccountantBookkeeping::create($defaults['bookkeeping']);

		// saving accountant_payroll_run
		foreach (['employee', 'subcontractor'] as $type) { 
			$data = [
				'accountant_id' => $accountant->id,
				'type' => $type,
				'value' => $defaults['payroll']['charge_per_pay_run'],
				'based_on' => 'all_clients',
				'allclients_base_fee' => $defaults['payroll']['processing_charge']
			];
			AccountantPayRun::create($data);
		}
		
		// saving modules
		foreach ($defaults['modules'] as $name => $val) {
			$data = [
				'module_id' => Module::getId($name),
				'accountant_id' => $accountant->id,
				'value' => $val,	
			];
			$model = new AccountantModule;
			$model->create($data);
		}

		// saving client other services	
		foreach ($defaults['other_services'] as $name => $val) {
			$data = [
				'other_service_id' => OtherService::getId($name),
				'accountant_id' => $accountant->id,
				'value' => $val,	
			];

			$model = new AccountantOtherService;
			$model->create($data);
		}
		$accountant->update(array('last_tab' => 'services'));
	}

}
