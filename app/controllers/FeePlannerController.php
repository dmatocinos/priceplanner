<?php

class FeePlannerController extends BaseController {


	public function create($client_id) 
	{

		$form_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
			],
			'pricing' => [
				'business_type_id' => NULL,
				'turnover' => NULL,	
				'audit_requirement_id' => NULL,
				'record_type_id' => NULL,
				'record_quality_id' => NULL,
				'audit_requirement_id'	=> NULL,
				'audit_risk_id'	=> NULL,
				'vat_return' => NULL,
				'bookkeeping_hours',
				'bookkeeping_hours',
				'bookkeeping_days',
				'bookkeeping_hour_val',
				'bookkeeping_day_val',
				'client_id' => $client_id,
			],
			'tax_return_pricing' => TaxReturnPricing::getTaxReturnPricing($client_id),
			'tax_returns' => TaxReturn::getTaxReturns(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices(),	
			'edit'	=> FALSE,
			'client_id' => $client_id,
			'route' => 'setup.store',
		];
dd(TaxReturnPricing::getTaxReturnPricing($client_id));
		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function edit($client_id)
	{
		$form_data = [];
		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		
	}

	public function update()
	{
		$input = Input::all();

	}

}
