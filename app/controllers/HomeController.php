<?php

class HomeController extends BaseController {


	public function index() 
	{
		Asset::container('footer')->add('home-index-js', 'js/home/index.js');
		$accountant = $this->user->asAccountant();

		$form_data = array(
			'clients' => $accountant ? Client::getAll($accountant->id) : []
		);

		$this->layout->content = View::make("pages.list", $form_data);
	}

	public function deleteClient($id) 
	{
		Client::find($id)->delete();

		return Redirect::to('home')
			->withInput()
			->with('message', 'Successfully deleted a client.');
	}
	
}
