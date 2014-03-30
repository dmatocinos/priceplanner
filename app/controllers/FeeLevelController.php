<?php

class FeeLevelController extends BaseController {


	public function create($client_id) 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');

		$client = Client::find($client_id);
		$pricing = $client->pricing()->first();

		$form_data = [
			'fee_levels' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'turnover_ranges' => TurnoverRange::getTurnoverRanges(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
				'tax_returns' => TaxReturn::getTaxReturns(),
				'ranges' => Range::getRanges(),
				'periods' => Period::getPeriods(),
				'modules' => Module::getModules(),
				'other_services' => OtherService::getOtherServices(),	
			],
			'client' => $client->getAttributes(),
			'accountant' => $client->accountant->toArray(),
			'edit'	=> FALSE,
			'has_fee_levels' => $client->hasOne('BusinessType'),
			'route' => 'feelevels.store',
			'client_id' => $client_id,
			'pricing_id' =>  $pricing ? $pricing->id : NULL
		];

		$this->layout->content = View::make("pages.feelevels", $form_data);
	}

	public function edit($client_id)
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');

		$client = Client::find($client_id);
		$pricing = $client->pricing()->first();
		$client_feelevels = [
			'business_types' => DB::table('client_business_types')
						->where('client_id', $client->id)
						->lists('base_fee', 'business_type_id'),

			'turnover_ranges' => DB::table('client_turnover_ranges')
						->where('client_id', $client->id)
						->lists('modifier', 'turnover_range_id'),
			
			'audit_requirements' => DB::table('client_audit_requirements')
						->where('client_id', $client->id)
						->lists('value', 'audit_requirement_id'),

			'audit_risks' => DB::table('client_audit_risks')
						->where('client_id', $client->id)
						->lists('percentage', 'audit_risk_id'),

			'tax_returns' => DB::table('client_tax_returns')
						->where('client_id', $client->id)
						->lists('value', 'tax_return_id'),

			'vat_returns' => DB::table('client_vat_returns')
						->where('client_id', $client->id)
						->pluck('value'),

			'record_qualities' => DB::table('client_record_qualities')
						->where('client_id', $client->id)
						->lists('percentage', 'record_quality_id'),

			'employee_period_ranges' => ClientEmployeePeriodRange::getClientEmployeePeriodRanges($client_id),

			'subcontractor_period_ranges' => ClientSubcontractorPeriodRange::getClientSubcontractorPeriodRanges($client_id),

			'modules' => DB::table('client_modules')
						->where('client_id', $client->id)
						->lists('value', 'module_id'),

			'other_services' => DB::table('client_other_services')
						->where('client_id', $client->id)
						->lists('value', 'other_service_id'),
		];

		$form_data = [
			'fee_levels' => [
				'business_types' => BusinessType::getBusinessTypes(),
				'turnover_ranges' => TurnoverRange::getTurnoverRanges(),
				'record_types' => AccountingType::getAccountingTypes(),
				'record_qualities' => RecordQuality::getRecordQualities(),
				'audit_requirements' => AuditRequirement::getAuditRequirements(),
				'audit_risks' => AuditRisk::getAuditRisks(),
				'tax_returns' => TaxReturn::getTaxReturns(),
				'ranges' => Range::getRanges(),
				'periods' => Period::getPeriods(),
				'modules' => Module::getModules(),
				'other_services' => OtherService::getOtherServices(),	
			],
			'client' => $client->getAttributes() + $client_feelevels,
			'accountant' => $client->accountant->toArray(),
			'edit'	=> TRUE,
			'has_fee_levels' => $client->hasOne('BusinessType'),
			'route' => 'feelevels.update',
			'client_id' => $client_id,
			'pricing_id' =>  $pricing ? $pricing->id : NULL
		];

		$this->layout->content = View::make("pages.feelevels", $form_data);
	}

	public function store()
	{
		$all = Input::all();
		$input = $all['fee_levels'];
		$client = Client::find($all['client_id']);
		$pricing = $client->pricing()->first();


		// saving client business_types
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'client_id' => $client->id,
				'business_type_id' => $id
			];
			$model = new ClientBusinessType;
			$model->create($data);
		}
 			
		// saving client turnover_ranges
		foreach ($input['turnover_ranges'] as $id => $val) {
			$data = [
				'modifier' => $val,
				'client_id' => $client->id,
				'turnover_range_id' => $id
			];
			$model = new ClientTurnoverRange;
			$model->create($data);
		}

		// saving client record_qualities
		foreach ($input['record_qualities'] as $atid => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'percentage' => $val,
					'client_id' => $client->id,
					'record_quality_id' => $id,
					'accounting_type_id' => $atid
				];

				$model = new ClientRecordQuality;
				$model->create($data);
			}
		}

		// saving client audit_requirements
		foreach ($input['audit_requirements'] as $id => $val) {
			$data = [
				'value' => $val,
				'client_id' => $client->id,
				'audit_requirement_id' => $id
			];
			$model = new ClientAuditRequirement;
			$model->create($data);
		}

		// saving client audit_risks
		foreach ($input['audit_risks'] as $id => $val) {
			$data = [
				'percentage' => $val,
				'client_id' => $client->id,
				'audit_risk_id' => $id
			];
			$model = new ClientAuditRisk;
			$model->create($data);
		}

		// saving client tax returns
		foreach ($input['tax_returns'] as $id => $val) {
			$data = [
				'value' => $val,
				'client_id' => $client->id,
				'tax_return_id' => $id
			];
			$model = new ClientTaxReturn;
			$model->create($data);
		}

		// saving VAT returns
		$model = new ClientVatReturn;
		$model->create(['client_id' => $client->id, 'value' => $input['vat_returns']]);
		

		// saving client employee_period_ranges
		foreach ($input['employee_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'client_id' => $client->id,
					'employee_period_range_id' => DB::table('employee_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new ClientEmployeePeriodRange;
				$model->create($data);
			}
		}

		// saving client employee_period_ranges
		foreach ($input['subcontractor_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'client_id' => $client->id,
					'subcontractor_period_range_id' => DB::table('subcontractor_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new ClientSubcontractorPeriodRange;
				$model->create($data);
			}
			
		}

		// client saving client module	
		foreach ($input['modules'] as $module_id => $qty) {
			$data = [
				'module_id' => $module_id,
				'client_id' => $client->id,
				'value' => $qty,	
			];
			$model = new ClientModule;
			$model->create($data);
		}

		// saving client other services	
		foreach ($input['other_services'] as $os_id => $qty) {
			$data = [
				'other_service_id' => $os_id,
				'client_id' => $client->id,
				'value' => $qty,	
			];
			$model = new ClientOtherService;
			$model->create($data);
		}

		$route = isset($all['save_next_page']) 
		       ? $pricing ? 'feeplanner/edit/' . $pricing->id : 'feeplanner/' . $client->id
		       : 'feelevels/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully created your fee levels.');
	}

	public function update()
	{
		$all = Input::all();
		$input = $all['fee_levels'];

		$all = Input::all();
		$input = $all['fee_levels'];
		$client = Client::find($all['client_id']);
		$pricing = $client->pricing()->first();

		// saving client business_types
		ClientBusinessType::where('client_id', $client->id)->delete();
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'client_id' => $client->id,
				'business_type_id' => $id
			];
			$model = new ClientBusinessType;
			$model->create($data);
		}
 			
		// saving client turnover_ranges
		ClientTurnoverRange::where('client_id', $client->id)->delete();
		foreach ($input['turnover_ranges'] as $id => $val) {
			$data = [
				'modifier' => $val,
				'client_id' => $client->id,
				'turnover_range_id' => $id
			];
			$model = new ClientTurnoverRange;
			$model->create($data);
		}

		// saving client record_qualities
		ClientRecordQuality::where('client_id', $client->id)->delete();
		foreach ($input['record_qualities'] as $atid => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'percentage' => $val,
					'client_id' => $client->id,
					'record_quality_id' => $id,
					'accounting_type_id' => $atid
				];
				$model = new ClientRecordQuality;
				$model->create($data);
			}
		}

		// saving client audit_requirements
		ClientAuditRequirement::where('client_id', $client->id)->delete();
		foreach ($input['audit_requirements'] as $id => $val) {
			$data = [
				'value' => $val,
				'client_id' => $client->id,
				'audit_requirement_id' => $id
			];
			$model = new ClientAuditRequirement;
			$model->create($data);
		}

		// saving client audit_risks
		ClientAuditRisk::where('client_id', $client->id)->delete();
		foreach ($input['audit_risks'] as $id => $val) {
			$data = [
				'percentage' => $val,
				'client_id' => $client->id,
				'audit_risk_id' => $id
			];
			$model = new ClientAuditRisk;
			$model->create($data);
		}

		// saving client tax returns
		ClientTaxReturn::where('client_id', $client->id)->delete();
		foreach ($input['tax_returns'] as $id => $val) {
			$data = [
				'value' => $val,
				'client_id' => $client->id,
				'tax_return_id' => $id
			];
			$model = new ClientTaxReturn;
			$model->create($data);
		}

		// saving VAT returns
		ClientVatReturn::where('client_id', $client->id)->delete();
		$model = new ClientVatReturn;
		$model->create(['client_id' => $client->id, 'value' => $input['vat_returns']]);
		

		// saving client employee_period_ranges
		ClientEmployeePeriodRange::where('client_id', $client->id)->delete();
		foreach ($input['employee_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'client_id' => $client->id,
					'employee_period_range_id' => DB::table('employee_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new ClientEmployeePeriodRange;
				$model->create($data);
			}
		}

		// saving client employee_period_ranges
		ClientSubcontractorPeriodRange::where('client_id', $client->id)->delete();
		foreach ($input['subcontractor_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'client_id' => $client->id,
					'subcontractor_period_range_id' => DB::table('subcontractor_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new ClientSubcontractorPeriodRange;
				$model->create($data);
			}
		}

		// client saving client module	
		ClientModule::where('client_id', $client->id)->delete();
		foreach ($input['modules'] as $module_id => $qty) {
			$data = [
				'module_id' => $module_id,
				'client_id' => $client->id,
				'value' => $qty,	
			];
			$model = new ClientModule;
			$model->create($data);
		}

		// saving client other services	
		ClientOtherService::where('client_id', $client->id)->delete();
		foreach ($input['other_services'] as $os_id => $qty) {
			$data = [
				'other_service_id' => $os_id,
				'client_id' => $client->id,
				'value' => $qty,	
			];
			$model = new ClientOtherService;
			$model->create($data);
		}

		$route = isset($all['save_next_page']) 
		       ? $pricing ? 'feeplanner/edit/' . $pricing->id : 'feeplanner/' . $client->id
		       : 'feelevels/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated your feelvels.');
	}

}
