<?php

class ReportController extends BaseController {

	public function fixedPrice($pricing_id)
	{
		$pricing = Pricing::findOrFail($pricing_id);
		$calc = new PlanSummaryCalculator($pricing);
		
		$generator = new ReportPdfGenerator($pricing, $calc);
		$generator->generate();
	}

	public function appendix($pricing_id)
	{
		$pricing = Pricing::findOrFail($pricing_id);
		$calc = new PlanSummaryCalculator($pricing);
		
		$generator = new ReportPdfGenerator($pricing, $calc);
		$generator->generateAppendix();
	}

	protected function createPricingStub()
	{
		$pricing = new Pricing(array());
		$faker = Faker::create();

		$accountant = new Accountant(array(
			'accountant_name'	=> $faker->name,
			'accountancy_name'	=> $faker->lastName . " Firm",
			'address'		=> $faker->address,
		));

		$client = new Client(array(
			'client_name'	=> $faker->name,
			'business_name'	=> $faker->lastName . " Company",
			'address'	=> $faker->address,
			'accounting_period'	=> $faker->date
		));
		$client->accountant = $accountant;

		$module_pricings = array();
		$modules = Module::all();
		foreach (Module::take(rand(1, count($modules)))->get() as $module) {
			$module_pricing = new ModulePricing();
			$module_pricing->module = $module;
			$module_pricings[] = $module_pricing;
		}

		$other_service_pricings = array();
		$other_services = OtherService::all();
		foreach (OtherService::take(rand(1, count($other_services)))->get() as $other_service) {
			$other_service_pricing = new OtherServicePricing();
			$other_service_pricing->qty = rand(1, 7);
			$other_service_pricing->other_service = $other_service;
			$other_service_pricings[] = $other_service_pricing;
		}

		$pricing = new Pricing(array(
			'turnover'	=> 1231
		));
		$pricing->client = $client;
		$pricing->module_pricings = $module_pricings;
		$pricing->other_service_pricings = $other_service_pricings;

		return $pricing;
	}

}

