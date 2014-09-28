<?php

class PracticeDetailsBookkeepingController extends PracticeDetailsController {
	protected $current_tab = "bookkeeping";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		$defaults = $this->getDefaultValues();
		
		if ($accountant->accountant_bookkeeping->count()) {
			$hour_val = DB::table('accountant_bookkeepings')
				->where('accountant_id', $accountant->id)
				->pluck('hour_val');

			$day_val = DB::table('accountant_bookkeepings')
				->where('accountant_id', $accountant->id)
				->pluck('day_val');
			$edit = TRUE;
			$route = 'update';
		}
		else {
			$hour_val = $defaults['bookkeeping']['hour'];
			$day_val = $defaults['bookkeeping']['day'];
			$edit = FALSE;
			$route = 'store';
		}
		
		$form_data = [
				'hour_val' => $hour_val,
				'day_val' => $day_val,
				'edit'	=> $edit,
				'route' => 'practicedetails.bookkeeping.' . $route,
				'accountant_id' => $accountant->id,
		];
			
		$this->layout->content = View::make("pages.practicedetails.bookkeeping", $form_data);
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

		AccountantBookkeeping::where('accountant_id', $accountant->id)->delete();
		
		return $this->save($accountant, $input, 'updated');
	}
	
	protected function save($accountant, $input, $msg) 
	{
		// saving Bookkeeping Values
		$model = new AccountantBookkeeping;
		$model->create(['accountant_id' => $accountant->id, 'hour_val' => $input['hour_val'], 'day_val' => $input['day_val']]);
		
		$route = isset($input['save_next_page']) ? 'practicedetails/payrolls' : 'practicedetails/bookkeeping';

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully ' . $msg . ' bookkeeping practice details.');
	}

	public function reset($accountant_id)
	{
		$defaults = $this->getDefaultValues();

		AccountantBookkeeping::where('accountant_id', $accountant_id)->delete();
		$defaults['bookkeeping']['accountant_id'] = $accountant_id;
		AccountantBookkeeping::create($defaults['bookkeeping']);

		return Redirect::to('practicedetails/bookkeeping')
			->withInput()
			->with('message', 'Bookkeeping was reset.');
	}
}
