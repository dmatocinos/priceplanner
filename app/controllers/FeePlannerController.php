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
				'ranges' => Range::getRanges(),
			],
			'pricing' => array_fill_keys($pricing->getFillable(), NULL),
			'employee_period_ranges' => EmployeePayrollPricing::getEmployeePeriodRanges(null),
			'sc_period_ranges' => ScPayrollPricing::getScPeriodRanges(null),
			'periods' => Period::getPeriods(),
			'modules' => Module::getModules(),
			'other_services' => OtherService::getOtherServices(),	
			'module_pricings' => ModulePricing::getModulePricings(null),	
			'other_service_pricings' => OtherServicePricing::getOtherServicePricings(),	
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
		$epp_data = $input['employee_payroll_pricings'];
		$spp_data = $input['sc_payroll_pricings'];
		$mp_data = $input['module_pricings'];
		$osp_data = $input['other_service_pricings'];

		$p_validation = Validator::make($p_data, Pricing::$rules);
		if ($p_validation->passes()) {
			$pricing = new Pricing;
			$pricing = $pricing->create($p_data);
		}
		else {
			return Redirect::route('feeplanner.create')
				->withInput()
				->withErrors($p_validation)
				->with('message', 'There were validation errors.');
		}
		
		// saving employee payroll pricings	
		foreach ($epp_data as $period_id => $epp) {
			$data = [
				'employee_period_range_id' => DB::table('employee_period_ranges')
								->where('period_id', $period_id)
								->where('range_id', $epp['range_id'])
								->pluck('id'),
				'pricing_id' => $pricing->id		
			];
			$employee_payroll_pricing = new EmployeePayrollPricing;
			$employee_payroll_pricing->create($data);
		}

		// saving subcontractor payroll pricings	
		foreach ($spp_data as $period_id => $spp) {
			$data = [
				'sc_period_range_id' => DB::table('subcontractor_period_ranges')
								->where('period_id', $period_id)
								->where('range_id', $spp['range_id'])
								->pluck('id'),
				'pricing_id' => $pricing->id		
			];
			$sc_payroll_pricing = new ScPayrollPricing;
			$sc_payroll_pricing->create($data);
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

		$route = isset($input['save_next_page']) 
		       ? 'plansummary/' 
		       : 'feeplanner/edit/';

		return Redirect::to($route . $pricing->id)
			->withInput()
			->with('message', 'You have successfully created your plan.');
	}

	public function update()
	{
		$input = Input::all();
		$p_data = $input['pricing'];
		$epp_data = $input['employee_payroll_pricings'];
		$spp_data = $input['sc_payroll_pricings'];
		$mp_data = $input['module_pricings'];
		$osp_data = $input['other_service_pricings'];

		$p_validation = Validator::make($p_data, Pricing::$rules);
		if ($p_validation->passes()) {
			$pricing = Pricing::find($p_data['id']);
			$pricing->update($p_data);
		}
		else {
			return Redirect::route('feeplanner.create')
				->withInput()
				->withErrors($p_validation)
				->with('message', 'There were validation errors.');
		}

		// saving employee payroll pricings	
		EmployeePayrollPricing::where('pricing_id', $pricing->id)->delete();
		foreach ($epp_data as $period_id => $epp) {
			$data = [
				'employee_period_range_id' => DB::table('employee_period_ranges')
								->where('period_id', $period_id)
								->where('range_id', $epp['range_id'])
								->pluck('id'),
				'pricing_id' => $pricing->id		
			];
			$employee_payroll_pricing = new EmployeePayrollPricing;
			$employee_payroll_pricing->create($data);
		}

		// saving subcontractor payroll pricings	
		ScPayrollPricing::where('pricing_id', $pricing->id)->delete();
		foreach ($spp_data as $period_id => $spp) {
			$data = [
				'sc_period_range_id' => DB::table('subcontractor_period_ranges')
								->where('period_id', $period_id)
								->where('range_id', $spp['range_id'])
								->pluck('id'),
				'pricing_id' => $pricing->id		
			];
			$sc_payroll_pricing = new ScPayrollPricing;
			$sc_payroll_pricing->create($data);
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

		$route = isset($input['save_next_page']) 
		       ? 'plansummary/' 
		       : 'feeplanner/edit/';

		return Redirect::to($route . $pricing->id)
			->withInput()
			->with('message', 'You have successfully updated your plan.');

	}

}
