<?php

class PracticeDetailsServicesController extends PracticeDetailsController {
	protected $current_tab = "services";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_modules->count()) {
			$accountant_modules = DB::table('accountant_modules')
				->where('accountant_id', $accountant->id)
				->lists('value', 'module_id');
			$accountant_other_services = DB::table('accountant_other_services')
				->where('accountant_id', $accountant->id)
				->lists('value', 'other_service_id');
			$edit = TRUE;
			$route = 'update';
		}
		else {
			$accountant_modules = NULL;
			$accountant_other_services = null;
			$edit = FALSE;
			$route = 'store';
		}
		
		$form_data = [
				'modules' => Module::getModules(),
				'other_services' => OtherService::getOtherServices(),	
				'accountant_modules' => $accountant_modules,
				'accountant_other_services' => $accountant_other_services,
				'edit'	=> $edit,
				'route' => 'practicedetails.services.' . $route,
				'accountant_id' => $accountant->id
		];
			
		$this->layout->content = View::make("pages.practicedetails.services", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => 'completed'));
		
		return $this->save($accountant, $input, 'created');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => 'completed'));
		
		AccountantModule::where('accountant_id', $accountant->id)->delete();
		AccountantOtherService::where('accountant_id', $accountant->id)->delete();
		
		return $this->save($accountant, $input, 'updated');
	}
	
	protected function save($accountant, $input, $msg) 
	{
		foreach ($input['modules'] as $module_id => $qty) {
			$data = [
				'module_id' => $module_id,
				'accountant_id' => $accountant->id,
				'value' => $qty,	
			];
			$model = new AccountantModule;
			$model->create($data);
		}

		// saving client other services	
		foreach ($input['other_services'] as $os_id => $qty) {
			$data = [
				'other_service_id' => $os_id,
				'accountant_id' => $accountant->id,
				'value' => $qty,	
			];
			$model = new AccountantOtherService;
			$model->create($data);
		}

		return Redirect::to('practicedetails/services')
			->withInput()
			->with('message', 'Successfully saved Modules & Services.');
	}
}
