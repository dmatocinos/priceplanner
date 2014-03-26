<?php

class FeePlannerController extends BaseController {


	public function create($client_id) 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');

		$form_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
				'ranges' => Range::getRanges(),
			],
			'pricing' => [
				'business_type_id' => NULL,
				'turnover' => NULL,	
				'audit_requirement_id' => NULL,
				'record_type_id' => NULL,
				'record_quality_id' => NULL,
				'audit_requirement_id'	=> NULL,
				'audit_risk_id'	=> NULL,
				'corporate_tax_return' => NULL,
				'partnership_tax_return' => NULL,
				'self_assessment_tax_return' => NULL,
				'vat_return' => NULL,
				'bookkeeping_hours' => NULL,
				'bookkeeping_days' => NULL,
				'bookkeeping_hour_val' => NULL,
				'bookkeeping_day_val' => NULL,
				'client_id' => $client_id,
			],
			'employee_period_ranges' => EmployeePayrollPricing::getEmployeePeriodRanges(null),
			'sc_period_ranges' => ScPayrollPricing::getScPeriodRanges(null),
			'periods' => Period::getPeriods(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices(),	
			'module_pricings' => ModulePricing::getModulePricings(null),	
			'other_service_pricings' => OtherServicePricing::getOtherServicePricings(),	
			'edit'	=> FALSE,
			'client_id' => $client_id,
			'route' => 'setup.store',
		];

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
