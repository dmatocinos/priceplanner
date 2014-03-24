<?php

class FeePlannerController extends BaseController {


	public function create($client_id) 
	{
		$form_data = [
			'client_id' => $client_id,
			'edit'	=> FALSE,
			'route' => 'setup.store'

		];
		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function edit($client_id)
	{
		$form_data = [];
		$this->layout->content = View::make("pages.feeplanner", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		
	}

	public function update()
	{
		$input = Input::all();

	}

}
