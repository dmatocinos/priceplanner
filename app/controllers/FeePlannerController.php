<?php

class FeePlannerController extends BaseController {

	public function create($client_id) 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$pricing = new Pricing;
		$client = Client::find($client_id);
		
		$form_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
			],
			'pricing' => array_fill_keys($pricing->getFillable(), null),
			'periods' => Period::getPeriods(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices($client->accountant_id),	
			'module_pricings' => ModulePricing::getModulePricings(),	
			'other_service_pricings' => OtherServicePricing::getOtherServicePricings(),	
			'tax_returns' => TaxReturn::getOtherTaxReturns($client->accountant_id, true),	
			'tax_return_pricings' => TaxReturnPricing::getTaxReturnPricings($client->accountant_id),	
			'edit'	=> FALSE,
			'client_id' => $client_id,
			'client_name' => $client->client_name,
			'route' => 'feeplanner.store',
		];

		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function edit($pricing_id)
	{

		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$pricing = Pricing::find($pricing_id);
		$client = Client::find($pricing->client_id);		

		$form_data = [
			'select_data' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
			],
			'pricing' => $pricing->getAttributes(),
			'periods' => Period::getPeriods(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices($client->accountant_id),	
			'module_pricings' => ModulePricing::getModulePricings($pricing_id),	
			'other_service_pricings' => OtherServicePricing::getOtherServicePricings($pricing_id),	
			'tax_returns' => TaxReturn::getOtherTaxReturns($client->accountant_id, true),	
			'tax_return_pricings' => TaxReturnPricing::getTaxReturnPricings($client->accountant_id, $pricing_id),	
			'edit'	=> TRUE,
			'client_id' => $pricing->client_id,
			'pricing_id' => $pricing->id,
			'client_name' => $client->client_name,
			'route' => 'feeplanner.update',
		];

		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$p_data = $input['pricing'];
		$mp_data = $input['module_pricings'];
		$osp_data = $input['other_service_pricings'];
		$trp_data = isset($input['tax_return_pricings']) ? $input['tax_return_pricings'] : [];

		$p_validation = Validator::make($p_data, Pricing::$rules);
		if ($p_validation->passes()) {
			$pricing = new Pricing;
			$pricing = $pricing->create($p_data);
		}
		else {
			return Redirect::to('feeplanner/' . $input['pricing']['client_id'])
				->withInput()
				->withErrors($p_validation)
				->with('message', 'There were validation errors.');
		}
		
		// saving module pricings	
		foreach ($mp_data as $module_id => $qty) {
			$data = [
				'module_id' => $module_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$module_pricing = new ModulePricing;
			$module_pricing->create($data);
		}

		// saving other services pricings	
		foreach ($osp_data as $os_id => $qty) {
			$data = [
				'other_service_id' => $os_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$other_service_pricing = new OtherServicePricing;
			$other_service_pricing->create($data);
		}

		// saving tax returns pricings	
		foreach ($trp_data as $tr_id => $qty) {
			$data = [
				'tax_return_id' => $tr_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$tax_return_pricing = new TaxReturnPricing;
			$tax_return_pricing->create($data);
		}

		$route = isset($input['save_next_page']) 
		       ? 'plansummary/' 
		       : 'feeplanner/edit/';

		return Redirect::to($route . $pricing->id)
			->withInput()
			->with('message', 'Successfully saved Fee Planner.');
	}

	public function update()
	{
		$input = Input::all();
		$p_data = $input['pricing'];
		$mp_data = $input['module_pricings'];
		$osp_data = $input['other_service_pricings'];
		$trp_data = isset($input['tax_return_pricings']) ? $input['tax_return_pricings'] : [];

		$p_validation = Validator::make($p_data, Pricing::$rules);
		if ($p_validation->passes()) {
			$pricing = Pricing::find($p_data['id']);
			$pricing->update($p_data);
		}
		else {
			return Redirect::to('feeplanner/edit/' . $p_data['id'])
				->withInput()
				->withErrors($p_validation)
				->with('message', 'There were validation errors.');
		}

		// saving module pricings	
		ModulePricing::where('pricing_id', $pricing->id)->delete();
		foreach ($mp_data as $module_id => $qty) {
			$data = [
				'module_id' => $module_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$module_pricing = new ModulePricing;
			$module_pricing->create($data);
		}

		// saving other services pricings	
		OtherServicePricing::where('pricing_id', $pricing->id)->delete();
		foreach ($osp_data as $os_id => $qty) {
			$data = [
				'other_service_id' => $os_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$other_service_pricing = new OtherServicePricing;
			$other_service_pricing->create($data);
		}

		// saving other services pricings	
		TaxReturnPricing::where('pricing_id', $pricing->id)->delete();
		foreach ($trp_data as $tr_id => $qty) {
			$data = [
				'tax_return_id' => $tr_id,
				'pricing_id' => $pricing->id,
				'qty' => $qty,	
			];
			$tax_return_pricing = new TaxReturnPricing;
			$tax_return_pricing->create($data);
		}

		$route = isset($input['save_next_page']) 
		       ? 'plansummary/' 
		       : 'feeplanner/edit/';

		return Redirect::to($route . $pricing->id)
			->withInput()
			->with('message', 'Successfully saved Fee Planner.');

	}

}
