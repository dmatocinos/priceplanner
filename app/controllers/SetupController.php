<?php

class HomeController extends BaseController {


	public function index() 
	{
		$form_data = array();		
		$this->layout->content = View::make("data_entry", $form_data);
	}

	public function index() 
	{
		Asset::container('footer')->add('home-index-js', 'js/home/index.js');
		
		$form_data = array(
			'remunerations' => Pricing::getAll(Sentry::getUser()->id)
		);
		
		$this->layout->content = View::make("pages.list", $form_data);
	}

}
