<?php

class PracticeDetailsAuditController extends PracticeDetailsController {
	protected $current_tab = "audit";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_audit_requirements->count() && $accountant->accountant_audit_risks->count()) {
			$form_data = [
					'audit_requirements' => AuditRequirement::getAuditRequirements(),
					'audit_risks' => AuditRisk::getAuditRisks(),
					'accountant_audit_requirements' => DB::table('accountant_audit_requirements')
						->where('accountant_id', $accountant->id)
						->lists('value', 'audit_requirement_id'),
					'accountant_audit_risks' => DB::table('accountant_audit_risks')
						->where('accountant_id', $accountant->id)
						->lists('percentage', 'audit_risk_id'),
					'edit'	=> TRUE,
					'route' => 'practicedetails.audit.update',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
		else {
			$form_data = [
					'audit_requirements' => AuditRequirement::getAuditRequirements(),
					'audit_risks' => AuditRisk::getAuditRisks(),
					'edit'	=> FALSE,
					'route' => 'practicedetails.audit.store',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.audit", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));

		// saving client audit_requirements
		foreach ($input['audit_requirements'] as $id => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant->id,
				'audit_requirement_id' => $id
			];
			$model = new AccountantAuditRequirement;
			$model->create($data);
		}
		
		// saving client audit_risks
		foreach ($input['audit_risks'] as $id => $val) {
			$data = [
				'percentage' => $val,
				'accountant_id' => $accountant->id,
				'audit_risk_id' => $id
			];
			$model = new AccountantAuditRisk;
			$model->create($data);
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/taxes' : 'practicedetails/audit';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Audit details.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;

		AccountantAuditRequirement::where('accountant_id', $accountant->id)->delete();

		// saving client audit_requirements
		foreach ($input['audit_requirements'] as $id => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant->id,
				'audit_requirement_id' => $id
			];
			$model = new AccountantAuditRequirement;
			$model->create($data);
		}

		AccountantAuditRisk::where('accountant_id', $accountant->id)->delete();

		// saving client audit_risks
		foreach ($input['audit_risks'] as $id => $val) {
			$data = [
				'percentage' => $val,
				'accountant_id' => $accountant->id,
				'audit_risk_id' => $id
			];
			$model = new AccountantAuditRisk;
			$model->create($data);
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/taxes' : 'practicedetails/audit';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Audit details.');
	}

	public function reset($accountant_id)
	{
		AccountantAuditRequirement::where('accountant_id', $accountant_id)->delete();
		$defaults = $this->getDefaultValues();

		$audit_requirements = [1 => $defaults['audit_requirement'], 2 => 0];
		foreach ($audit_requirements as $id => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant_id,
				'audit_requirement_id' => $id
			];
			$model = new AccountantAuditRequirement;
			$model->create($data);
		}

		AccountantAuditRisk::where('accountant_id', $accountant_id)->delete();

		foreach ($defaults['audit_risk'] as $name => $val) {
			$data = [
				'percentage' => $val,
				'accountant_id' => $accountant_id,
				'audit_risk_id' => AuditRisk::getId($name)
			];
			$model = new AccountantAuditRisk;
			$model->create($data);
		}

		return Redirect::to('practicedetails/audit')
			->withInput()
			->with('message', 'Audit was reset.');
	}
}
