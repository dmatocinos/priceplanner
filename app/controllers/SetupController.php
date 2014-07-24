<?php

class SetupController extends BaseController {

	private function setupData($client_data, $is_edit = false)
	{
		Asset::container('footer')->add('client-index-js', 'js/client/index.js');

		$data = Input::get();

		$db = DB::connection('practicepro_users');
		$data = [
			'currencies'    => $db->table('currencies')->lists('name', 'id'),
			'counties'      => ['' => ''] + $db->table('counties')->lists('county', 'county'),
			'countries'     => ['' => ''] + $db->table('countries')->lists('country_name', 'country_name'),
			'client_data'	=> $client_data,
			'edit'	=> $is_edit,
		];

		$this->layout->content = View::make('pages.setup', $data);		

	}

	public function addClient()
	{
		$input = Input::all();
		if ($input['select_by'] == 'existing') {
			return Redirect::to('client_details/existing/' . $input['client_id']);
		}
		else {
			return Redirect::to('client_details/new');
		}
	}

	public function editClient($id)
	{
		$client = Client::find($id);
		$pricing = $client->pricing;
		$pp_client = PracticeProClient::on('practicepro_users')->find($client->client_id);

		$data = [
				'client_id' => $client->id,
				'pricing_id' =>  $pricing ? $pricing->id : NULL,
				'pp_client_id' => $pp_client->id
		];
		$this->setupData($pp_client->getAttributes() + $data, true);
	}

	public function newClient()
	{
		$client = new PracticeProClient;
		$this->setupData(array_fill_keys($client->getFillable(), null));
	}

	public function existingClient($client_id)
	{
		$client = PracticeProClient::on('practicepro_users')->find($client_id);
		$this->setupData($client->getAttributes());
	}


	public function createClient() 
	{
		$input = Input::all();
		
		$validator = Validator::make($input, PracticeProClient::$rules);
		if ($validator->passes()) {
			
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));

			$client = PracticeProClient::create($input);
			$accountant = $this->user->accountant;

			// save to existing app data
			$data = $input + [
				'client_name'    => $input['contact_name'],
				'business_name'    => $input['business_name'],
				'street_address'   => $input['address_1'],
				'city_address'	   => $input['city'],
				'state_address'	   => $input['county'],
				'country_address'  => $input['country'],
				'zip_address'	   => $input['postcode'],
				'pp_client_id'	   => $client->id,
				'accountant_id'    => $accountant->id
			];
			return $this->save($data);

		}
		else {
			return Redirect::to('client_details/new')
				->withInput()
				->withErrors($validator)
				->with('message', 'There were validation errors.');
		}
	}

	public function updateClient() 
	{
		$input = Input::all();
		
		$validator = Validator::make($input, PracticeProClient::$rules);
		if ($validator->passes()) {
			
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));
			$client = PracticeProClient::find($input['id']);
			$client->update($input);

			$accountant = $this->user->accountant;

			// save to existing app data
			$data = $input + [
				'client_name'    => $input['contact_name'],
				'business_name'    => $input['business_name'],
				'street_address'   => $input['address_1'],
				'city_address'	   => $input['city'],
				'state_address'	   => $input['county'],
				'country_address'  => $input['country'],
				'zip_address'	   => $input['postcode'],
				'pp_client_id'	   => $client->id,
				'accountant_id'    => $accountant->id
			];
			return $this->save($data);

		}
		else {
			return Redirect::to('client_details/existing/' . $input['id'])
				->withInput()
				->withErrors($validator)
				->with('message', 'There were validation errors.');
		}
		
	}

	private function save($data)
	{
		if (isset($data['client_id'])) {
			$client = Client::find($data['client_id']);
			$data['client_id'] = $data['pp_client_id'];
			$client->update($data);
			$pricing = $client->pricing;

			$route = isset($data['save_next_page']) 
			       ? ($pricing ? 'feeplanner/edit/' . $pricing->id : 'feeplanner/' . $client->id)
			       : 'setup/edit/' . $client->id;
		}
		else {
			$client = new Client;
			$data['client_id'] = $data['pp_client_id'];
			$client = $client->create($data);

			$pricing = $client->pricing;
			$route = isset($data['save_next_page']) 
			       ? ($pricing ? ('feeplanner/edit/' . $pricing->id) : ('feeplanner/' . $client->id))
			       : 'setup/edit/' . $client->id;
		}

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Setup.');
	}

}
