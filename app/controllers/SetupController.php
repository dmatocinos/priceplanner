<?php

class SetupController extends BaseController {

	public function index() 
	{
		$client_data = [
			
		];
		
		$accountant_data = [

		];

		$form_data = [
				'client' => [],
				'accountant' => [],
				'route' => 'create'

		];
		$this->layout->content = View::make("pages.setup", $form_data);
	}

	public function setup()
	{

	}

}
