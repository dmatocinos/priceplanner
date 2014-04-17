<?php

class PracticeDetailsRequirementsController extends PracticeDetailsController {
	protected $current_tab = "requirements";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_audit_requirements->count()) {
			$form_data = [
					'audit_requirements' => AuditRequirement::getAuditRequirements(),
					'accountant_audit_requirements' => DB::table('accountant_audit_requirements')
						->where('accountant_id', $accountant->id)
						->lists('value', 'audit_requirement_id'),
					'edit'	=> TRUE,
					'route' => 'practicedetails.requirements.update',
					'accountant_id' => $accountant->id
			];
		}
		else {
			$form_data = [
					'audit_requirements' => AuditRequirement::getAuditRequirements(),
					'edit'	=> FALSE,
					'route' => 'practicedetails.requirements.store',
					'accountant_id' => $accountant->id,
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.requirements", $form_data);
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
		
		$route = isset($input['save_next_page']) ? 'practicedetails/risks' : 'practicedetails/requirements';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Audit Requirements.');
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
		
		$route = isset($input['save_next_page']) ? 'practicedetails/risks' : 'practicedetails/requirements';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Audit Requirements.');
	}
}
