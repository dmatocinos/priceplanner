<?php

class SetupController extends BaseController {

	private function setupData($client_data, $is_edit = false)
	{
		Asset::container('footer')->add('client-index-js', 'js/client/index.js');

		$data = Input::get();

		$db = DB::connection('practicepro_users');
		$countries = $db->table('countries')->orderBy('country_name', 'asc')->lists('country_name', 'country_name');

		unset($countries['United Kingdom']);
		
		$countries = ['' => '', 'United Kingdom' => 'United Kingdom'] + $countries;

		$data = [
			'currencies'    => $db->table('currencies')->lists('name', 'id'),
			'counties'      => ['' => ''] + $db->table('counties')->lists('county', 'county'),
			'countries'     => $countries,
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
			return $this->save(null, $input);
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
			return $this->save($input['id'], $input);
		}
		else {
			return Redirect::to('client_details/existing/' . $input['id'])
				->withInput()
				->withErrors($validator)
				->with('message', 'There were validation errors.');
		}
		
	}

	private function save($practicepro_client_id, $practicepro_client_data)
	{
        $start_date = $practicepro_client_data['period_start_date'];
        $end_date   = $practicepro_client_data['period_end_date'];

        if (! empty($start_date)) {
            $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $start_date)));
        }
        
        if (! empty($end_date)) {
            $end_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $end_date)));
        }

        $practicepro_client_data['period_start_date'] = $start_date;
        $practicepro_client_data['period_end_date']   = $end_date;
        
        if ($practicepro_client_id) {
            $practicepro_client = PracticeProClient::find($practicepro_client_id);
			$practicepro_client->update($practicepro_client_data);
        }
        else {
            $practicepro_client = PracticeProClient::create($practicepro_client_data);
        }

        $accountant = $this->user->accountant;

        // save to existing app data
        $data = $practicepro_client_data + [
            'client_name'      => $practicepro_client_data['contact_name'],
            'business_name'    => $practicepro_client_data['business_name'],
            'street_address'   => $practicepro_client_data['address_1'],
            'city_address'	   => $practicepro_client_data['city'],
            'state_address'	   => $practicepro_client_data['county'],
            'country_address'  => $practicepro_client_data['country'],
            'zip_address'	   => $practicepro_client_data['postcode'],
            'pp_client_id'	   => $practicepro_client->id,
            'accountant_id'    => $accountant->id
        ];

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
