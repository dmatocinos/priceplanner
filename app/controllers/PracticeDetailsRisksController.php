<?php

class PracticeDetailsRisksController extends PracticeDetailsController {
	protected $current_tab = "risks";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_audit_risks->count()) {
			$accountant_audit_risks = DB::table('accountant_audit_risks')
				->where('accountant_id', $accountant->id)
				->lists('percentage', 'audit_risk_id');
			$edit = TRUE;
			$route = 'update';
		}
		else {
			$accountant_audit_risks = NULL;
			$edit = FALSE;
			$route = 'store';
		}
		
		$form_data = [
				'audit_risks' => AuditRisk::getAuditRisks(),
				'accountant_audit_risks' => $accountant_audit_risks,
				'edit'	=> $edit,
				'route' => 'practicedetails.risks.' . $route,
				'accountant_id' => $accountant->id
		];
			
		$this->layout->content = View::make("pages.practicedetails.risks", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
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
		
		$route = isset($input['save_next_page']) ? 'practicedetails/taxes' : 'practicedetails/risks';

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully created audit risks practice details.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;

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
		
		$route = isset($input['save_next_page']) ? 'practicedetails/taxes' : 'practicedetails/risks';

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated audit risks practice details.');
	}
}
