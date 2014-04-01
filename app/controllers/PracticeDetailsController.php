<?php

class PracticeDetailsController extends BaseController 
{
	protected $current_tab;
	
	public function __construct() 
	{
		parent::__construct();
		
		View::share('practice_detail_tabs', array(
			'setup' => 'Setup',
			'businesstypes' => 'Types of Business',
			'ranges' => 'Turnover Ranges',
			'qualities' => 'Record Qualities',
			'requirements' => 'Audit Requirements',
			'risks' => 'Audit Risks',
			'taxes' => 'Taxes',
			'payroll' => 'Payrolls',
			'services' => 'Modules & Services'
		));
		
		View::share('practice_detail_current_tab', $this->current_tab);
	}
}