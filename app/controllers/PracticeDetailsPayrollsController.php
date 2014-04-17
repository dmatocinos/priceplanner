<?php

class PracticeDetailsPayrollsController extends PracticeDetailsController {
	protected $current_tab = "payrolls";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_employee_period_ranges->count()) {
			$accountant_employee_period_ranges = AccountantEmployeePeriodRange::getAccountantEmployeePeriodRanges($accountant->id);
			$accountant_subcontractor_period_ranges = AccountantSubcontractorPeriodRange::getAccountantSubcontractorPeriodRanges($accountant->id);
			$edit = TRUE;
			$route = 'update';
		}
		else {
			$accountant_employee_period_ranges = NULL;
			$accountant_subcontractor_period_ranges = null;
			$edit = FALSE;
			$route = 'store';
		}
		
		$form_data = [
				'ranges' => Range::getRanges(),
				'periods' => Period::getPeriods(),
				'accountant_employee_period_ranges' => $accountant_employee_period_ranges,
				'accountant_subcontractor_period_ranges' => $accountant_subcontractor_period_ranges,
				'edit'	=> $edit,
				'route' => 'practicedetails.payrolls.' . $route,
				'accountant_id' => $accountant->id
		];
			
		$this->layout->content = View::make("pages.practicedetails.payrolls", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		return $this->save($accountant, $input, 'created');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;

		AccountantEmployeePeriodRange::where('accountant_id', $accountant->id)->delete();
		AccountantSubcontractorPeriodRange::where('accountant_id', $accountant->id)->delete();
		
		return $this->save($accountant, $input, 'updated');
	}
	
	protected function save($accountant, $input, $msg) 
	{
		// saving client employee_period_ranges
		foreach ($input['employee_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'accountant_id' => $accountant->id,
					'employee_period_range_id' => DB::table('employee_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new AccountantEmployeePeriodRange;
				$model->create($data);
			}
		}

		// saving client employee_period_ranges
		foreach ($input['subcontractor_period_ranges'] as $rid => $pids) {
			foreach($pids as $pid => $val) {
				$data = [
					'value' => $val,
					'accountant_id' => $accountant->id,
					'subcontractor_period_range_id' => DB::table('subcontractor_period_ranges')
									->where('period_id', $pid)
									->where('range_id', $rid)
									->pluck('id'),
				];
				$model = new AccountantSubcontractorPeriodRange;
				$model->create($data);
			}
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/services' : 'practicedetails/payrolls';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Payrolls.');
	}
}
