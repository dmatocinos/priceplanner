<?php

class PracticeDetailsRangesController extends PracticeDetailsController {
	protected $current_tab = "ranges";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_turnover_ranges->count()) {
			$form_data = [
					'turnover_ranges' => AccountantTurnoverRange::getAccountantTurnoverRanges($accountant->id),
					'edit'	=> TRUE,
					'route' => 'practicedetails.ranges.update',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
		else {
			$form_data = [
					'turnover_ranges' => AccountantTurnoverRange::getAccountantTurnoverRanges($accountant->id),
					'edit'	=> FALSE,
					'route' => 'practicedetails.ranges.store',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.ranges", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));

		// saving accountant turnover_ranges
		foreach ($input['turnover_ranges'] as $id => $input_val) {
			
			$data = [
				'accountant_id' => $accountant->id,
			];

			$data = $data + $input_val;

			$model = new AccountantTurnoverRange;
			$model->create($data);
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/qualities' : 'practicedetails/ranges';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Turnover Ranges.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;


		// saving accountant turnover_ranges
		foreach ($input['turnover_ranges'] as $id => $input_val) {
			$data = [
				'accountant_id' => $accountant->id,
			];

			$data = $data + $input_val;
			DB::table('accountant_turnover_ranges')
				->where('id', $id)
				->update($data);
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/qualities' : 'practicedetails/ranges';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Turnover Ranges.');
	}

	public function reset($accountant_id)
	{
		AccountantTurnoverRange::where('accountant_id', $accountant_id)->delete();
		$defaults = $this->getDefaultValues();

		foreach ($defaults['turnover_ranges'] as $data) {
			$data['accountant_id'] = $accountant_id;
			$model = new AccountantTurnoverRange;
			$model->create($data);
		}
		
		return Redirect::to('practicedetails/ranges')
			->withInput()
			->with('message', 'Turnover Ranges were reset.');
	}

}
