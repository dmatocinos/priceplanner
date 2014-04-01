<?php

class PracticeDetailsQualitiesController extends PracticeDetailsController {
	protected $current_tab = "qualities";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_record_qualities->count()) {
			$form_data = [
					'record_qualities' => RecordQuality::getRecordQualities(),
					'accountant_record_qualities' => [ 
								1 => DB::table('accountant_record_qualities')
									->where('accountant_id', $accountant->id)
									->where('accounting_type_id', 1)
									->lists('percentage', 'record_quality_id'),

								2 => DB::table('accountant_record_qualities')
									->where('accountant_id', $accountant->id)
									->where('accounting_type_id', 2)
									->lists('percentage', 'record_quality_id'),
					],
					'edit'	=> TRUE,
					'route' => 'practicedetails.qualities.update',
					'accountant_id' => $accountant->id
			];
		}
		else {
			$form_data = [
					'record_qualities' => RecordQuality::getRecordQualities(),
					'edit'	=> FALSE,
					'route' => 'practicedetails.qualities.store',
					'accountant_id' => $accountant->id,
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.qualities", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		// saving client record_qualities
		foreach ($input['record_qualities'] as $atid => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'percentage' => $val,
					'accountant_id' => $accountant->id,
					'record_quality_id' => $id,
					'accounting_type_id' => $atid
				];

				$model = new AccountantRecordQuality;
				$model->create($data);
			}
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/requirements' : ('practicedetails/' . $this->current_tab);

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully created record qualities practice details.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		AccountantRecordQuality::where('accountant_id', $accountant->id)->delete();
		
		// saving client record_qualities
		foreach ($input['record_qualities'] as $atid => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'percentage' => $val,
					'accountant_id' => $accountant->id,
					'record_quality_id' => $id,
					'accounting_type_id' => $atid
				];

				$model = new AccountantRecordQuality;
				$model->create($data);
			}
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/requirements' : ('practicedetails/' . $this->current_tab);

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated record qualities practice details.');
	}

}
