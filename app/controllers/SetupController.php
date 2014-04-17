<?php

class SetupController extends BaseController {


	public function create() 
	{
		Asset::container('footer')->add('pages-index-js', 'js/pages/index.js');

		$form_data = [
				'client' => [],
				'accountant' => [],
				'edit'	=> FALSE,
				'route' => 'setup.store',
				'client_id' => NULL,
		];
		
		$result    = DB::select("SELECT country_id, short_name FROM countries");
		$countries = array('- Select Country -');
		
		foreach ($result as $row) {
			$countries[$row->country_id] = $row->short_name;
		}
		
		$form_data['countries'] = $countries;
		
		$this->layout->content = View::make("pages.setup", $form_data);
	}

	public function edit($client_id)
	{
		Asset::container('footer')->add('pages-index-js', 'js/pages/index.js');

		$client = Client::find($client_id);
		$pricing = $client->pricing;
		
		$form_data = [
				'client' => $client->getAttributes(),
				'accountant' => $client->accountant->toArray(),
				'edit'	=> TRUE,
				'route' => 'setup.update',
				'client_id' => $client_id,
				'pricing_id' =>  $pricing ? $pricing->id : NULL
		];
		
		$result    = DB::select("SELECT country_id, short_name FROM countries");
		$countries = array('- Select Country -');
		
		foreach ($result as $row) {
			$countries[$row->country_id] = $row->short_name;
		}
		
		$form_data['countries'] = $countries;

		$this->layout->content = View::make("pages.setup", $form_data);
	}

	public function store()
	{
		$accountant = $this->user->accountant;
		$input = Input::all();
		
		$c_input = $input['client'];
		$c_input['accountant_id'] = $accountant->id;
		$c_input['period_start_date'] = date('Y-m-d H:i:a', strtotime($c_input['period_start_date']));
		$c_input['period_end_date'] = date('Y-m-d H:i:a', strtotime($c_input['period_end_date']));

		$c_validation = Validator::make($c_input, Client::$rules);
		if ($c_validation->passes()) {
			$client = new Client;
			$client = $client->create($c_input);
		}
		else {
			return Redirect::route('setup.create')
				->withInput()
				->withErrors($c_validation)
				->with('message', 'There were validation errors.');
		}

		$pricing = $client->pricing;
		
		$route = isset($input['save_next_page']) 
		       ? ($pricing ? 'feeplanner/edit/' . $pricing->id : 'feeplanner/' . $client->id)
		       : 'setup/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Setup.');

	}

	public function update()
	{
		$accountant = $this->user->accountant;
		$input = Input::all();
		$client = Client::find($input['client']['id']);
		
		$c_input = $input['client'];
		$c_input['accountant_id'] = $accountant->id;
		$c_input['period_start_date'] = date('Y-m-d H:i:a', strtotime($c_input['period_start_date']));
		$c_input['period_end_date'] = date('Y-m-d H:i:a', strtotime($c_input['period_end_date']));

		$c_validation = Validator::make($c_input, Client::$rules);
		if ($c_validation->passes()) {
			$client->update($c_input);
		}
		else {
			return Redirect::to('setup/edit/' . $client->id)
				->withInput()
				->withErrors($c_validation)
				->with('message', 'There were validation errors.');
		}

		$pricing = $client->pricing;
		$route = isset($input['save_next_page']) 
		       ? ($pricing ? ('feeplanner/edit/' . $pricing->id) : ('feeplanner/' . $client->id))
		       : 'setup/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Setup.');
	}

}
