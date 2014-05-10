<?php

class PracticeDetailsPayrollsController extends PracticeDetailsController {
	protected $current_tab = "payrolls";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		Asset::container('footer')->add('pages-payroll-js', 'js/pages/practice_details_payroll.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_pay_run) {
			$payrun = $accountant->accountant_pay_run->getAttributes();
			$edit = TRUE;
			$route = 'update';
			$all_clients_display = ($payrun['based_on'] == 'all_clients');
			$turnover_ranges_display = ($payrun['based_on'] == 'turnover_ranges');
		}
		else {
			$payrun = null;
			$edit = FALSE;
			$route = 'store';
			$all_clients_display = $turnover_ranges_display = false; 
		}
		
		$form_data = [
				'turnover_ranges' => AccountantTurnoverRange::getAccountantTurnoverRanges($accountant->id),
				'payrun' => $payrun,
				'payroll_runs' => AccountantPayrollRun::getPayrollRunTurnoverRanges($accountant->id),
				'edit'	=> $edit,
				'route' => 'practicedetails.payrolls.' . $route,
				'all_clients_display' => $all_clients_display,
				'turnover_ranges_display' => $turnover_ranges_display,
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

		AccountantPayRun::where('accountant_id', $accountant->id)->delete();
		AccountantPayrollRun::where('accountant_id', $accountant->id)->delete();
		
		return $this->save($accountant, $input, 'updated');
	}
	
	protected function save($accountant, $input, $msg) 
	{
		// saving accountant_payroll_run
		$data = $input['payrun'];
		$data['accountant_id'] = $accountant->id;
		$accountant_pay_run = new AccountantPayRun;
		$accountant_pay_run->create($data);
		
		// saving accountant_pay_run
		if ($data['based_on'] == 'turnover_ranges') {
			
			foreach ($input['payroll_turnover_ranges'] as $id => $val) {
				$data = [
					'value' => $val,
					'accountant_id' => $accountant->id,
					'accountant_turnover_range_id' => $id
				];
				$model = new AccountantPayrollRun;
				$model->create($data);
			}

			$accountant_pay_run->allclients_base_fee = 0;
			$accountant_pay_run->save();
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/services' : 'practicedetails/payrolls';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Payrolls.');
	}
}
