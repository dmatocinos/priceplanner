<?php

class PlanSummaryController extends BaseController
{

	public function index($pricing_id)
	{
		$pricing = Pricing::find($pricing_id);
		$client = Client::find($pricing->client_id);
		$calc = new PlanSummaryCalculator($pricing);

		$tpl_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
			],
			'pricing' => $pricing->getAttributes(),
			'client_id' => $pricing->client_id,
			'pricing_id' => $pricing->id,
			'client_name' => $client->client_name,
			'calc' => $calc
		];
		
		$this->layout->content = View::make("pages.plansummary", $tpl_data);
	}

}

