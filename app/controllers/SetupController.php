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
		
		$this->layout->content = View::make("pages.setup", $form_data);
	}

	public function edit($client_id)
	{
		Asset::container('footer')->add('pages-index-js', 'js/pages/index.js');

		$client = Client::find($client_id);
		$pricing = $client->pricing()->first();

		$form_data = [
				'client' => $client->getAttributes(),
				'accountant' => $client->accountant->toArray(),
				'edit'	=> TRUE,
				'has_fee_levels' => $client->hasOne('ClientBusinessType')->getResults(),
				'route' => 'setup.update',
				'client_id' => $client_id,
				'pricing_id' =>  $pricing ? $pricing->id : NULL
		];

		$this->layout->content = View::make("pages.setup", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$a_input = $input['accountant'];
		
		$a_validation = Validator::make($a_input, Accountant::$rules);
		if ($a_validation->passes()) {
			$accountant = new Accountant;
			$accountant = $accountant->create($a_input);

			if ($a_input['logo_filename']) { 
				//Upload the file
				$filename = $a_input['accountant_name'] . '_logo_' . $accountant->id;
				$a_input['logo_filename']->move(public_path() . '/uploads', $filename);
				$accountant->update(['logo_filename' => $filename]);
			}

		}
		else {
			return Redirect::route('setup.create')
				->withInput()
				->withErrors($a_validation)
				->with('message', 'There were validation errors.');
		}
		
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

		$pricing = $client->pricing()->first();
		$route = isset($input['save_next_page']) 
		       ? $client->hasOne('ClientBusinessType')->getResults() ? 'feelevels/edit/' . $client->id : 'feelevels/' . $client->id
		       : 'setup/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully started setting up.');

		
	}

	public function update()
	{
		$input = Input::all();

		$client = Client::find($input['client']['id']);
		$a_input = $input['accountant'];

		$a_validation = Validator::make($a_input, Accountant::$rules);
		if ($a_validation->passes()) {
			
			$accountant = Accountant::find($a_input['id']);

			if ($a_input['logo_filename']) { 
				//Upload the file
				$filename = $a_input['accountant_name'] . '_logo_' . $accountant->id;
				$a_input['logo_filename']->move(public_path() . '/uploads', $filename);
				$a_input['logo_filename'] = $filename;
			}
			else {
				unset($a_input['logo_filename']);
			}
		
			$accountant->update($a_input);
		}
		else {

			return Redirect::to('setup/edit/' . $client->id)
				->withInput()
				->withErrors($a_validation)
				->with('message', 'There were validation errors.' . $a_validation->errors());

		}
		
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

		$pricing = $client->pricing()->first();
		$route = isset($input['save_next_page']) 
		       ? $client->hasOne('ClientBusinessType')->getResults() ? 'feelevels/edit/' . $client->id : 'feelevels/' . $client->id
		       : 'setup/edit/' . $client->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated your setup.');
	}

}
