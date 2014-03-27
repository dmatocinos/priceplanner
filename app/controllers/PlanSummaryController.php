<?php

class PlanSummaryController extends BaseController
{

	public function index($pricing_id)
	{
		$pricing = Pricing::find($pricing_id);
		$calc = new PlanSummaryCalculator($pricing);

		$tpl_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
				'ranges' => Range::getRanges(),
			],
			'pricing' => $pricing->getAttributes(),
			'employee_period_ranges' => EmployeePayrollPricing::getEmployeePeriodRanges($pricing_id),
			'sc_period_ranges' => ScPayrollPricing::getScPeriodRanges($pricing_id),
			'periods' => Period::getPeriods(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices(),	
			'module_pricings' => ModulePricing::getModulePricings($pricing_id),	
			'other_service_pricings' => OtherServicePricing::getOtherServicePricings($pricing_id),	
			'client_id' => $pricing->client_id,
			'pricing_id' => $pricing->id,
			'calc' => $calc
		];
		

		$this->layout->content = View::make("pages.plansummary", $tpl_data);
	}

}

