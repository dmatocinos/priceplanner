<?php

class PracticeDetailsPayrollsController extends PracticeDetailsController {
	protected $current_tab = "payrolls";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		Asset::container('footer')->add('pages-payroll-js', 'js/pages/practice_details_payroll.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_pay_run) {
			$payruns = AccountantPayrun::getPayruns($accountant);
			$edit = TRUE;
			$route = 'update';
			$all_clients_employee_display = isset($payruns['employee']) ? ($payruns['employee']['based_on'] == 'all_clients') : false;
			$turnover_ranges_employee_display = isset($payruns['employee']) ? ($payruns['employee']['based_on'] == 'turnover_ranges') : false;
			$all_clients_subcontractor_display = isset($payruns['subcontractor']) ? ($payruns['subcontractor']['based_on'] == 'all_clients') : false;
			$turnover_ranges_subcontractor_display = isset($payruns['subcontractor']) ? ($payruns['subcontractor']['based_on'] == 'turnover_ranges') : false;
		}
		else {
			$payruns = null;
			$edit = FALSE;
			$route = 'store';
			$all_clients_employee_display = $turnover_ranges_employee_display = $all_clients_subcontractor_display = $turnover_ranges_subcontractor_display = false; 
		}
		
		$form_data = [
				'turnover_ranges' => AccountantTurnoverRange::getAccountantTurnoverRanges($accountant->id),
				'payruns' => $payruns,
				'payroll_runs' => AccountantPayrollRun::getPayrollRunTurnoverRanges($accountant->id),
				'edit'	=> $edit,
				'route' => 'practicedetails.payrolls.' . $route,
				'all_clients_employee_display' => $all_clients_employee_display,
				'turnover_ranges_employee_display' => $turnover_ranges_employee_display,
				'all_clients_subcontractor_display' => $all_clients_subcontractor_display,
				'turnover_ranges_subcontractor_display' => $turnover_ranges_subcontractor_display,
				'accountant_id' => $accountant->id,
				'defaults' => $this->getDefaultValues()
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
		$payruns = $input['payruns'];
		foreach($payruns as $type => $data) {
			$data['accountant_id'] = $accountant->id;
			$data['type'] = $type;
			$accountant_pay_run = new AccountantPayRun;
			$accountant_pay_run->create($data);

			if ($payruns[$type]['based_on'] == 'turnover_ranges') {
				$accountant_pay_run->allclients_base_fee = 0;
				$accountant_pay_run->save();
			}
		}
		
		// saving accountant_pay_run
			
		foreach ($input['payroll_turnover_ranges'] as $type => $payroll) {
			if ($payruns[$type]['based_on'] == 'turnover_ranges') {
				foreach($payroll as $id => $val) {
					$data = [
						'value' => $val,
						'accountant_id' => $accountant->id,
						'accountant_turnover_range_id' => $id,
						'type' => $type
					];
					$model = new AccountantPayrollRun;
					$model->create($data);
				}

			}
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/services' : 'practicedetails/payrolls';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Payrolls.');
	}

	public function reset($accountant_id)
	{
		AccountantPayRun::where('accountant_id', $accountant_id)->delete();
		AccountantPayrollRun::where('accountant_id', $accountant_id)->delete();
		$defaults = $this->getDefaultValues();

		foreach (['employee', 'subcontractor'] as $type) { 
			$data = [
				'accountant_id' => $accountant_id,
				'type' => $type,
				'value' => $defaults['payroll']['charge_per_pay_run'],
				'based_on' => 'all_clients',
				'allclients_base_fee' => $defaults['payroll']['processing_charge']
			];
			AccountantPayRun::create($data);
		}
		
		return Redirect::to('practicedetails/payrolls')
			->withInput()
			->with('message', 'Payrolls were reset.');
	}
}
