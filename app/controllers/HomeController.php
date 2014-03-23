<?php

class HomeController extends BaseController {


	public function index() 
	{
		Asset::container('footer')->add('home-index-js', 'js/home/index.js');
		
		$form_data = array(
			'clients' => Client::getAll($this->user->id)
		);
		
		$this->layout->content = View::make("pages.list", $form_data);
	}

}
