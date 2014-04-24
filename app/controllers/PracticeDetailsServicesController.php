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

		$edit_services = $accountant->accountant_other_services->count();		

		$form_data = [
				'modules' => Module::getModules(),
				'other_services' => $edit_services ? OtherService::getOtherServices($accountant->id, null) : OtherService::getOtherServices(),	
				'other_services_extra' => OtherService::getOtherServices($accountant->id, true),	
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
		foreach ($input['other_services_extra'] as $mod) {
			if ($mod['name'] != '' && $mod['value'] != '') {
				$other_service = new OtherService;
				$other_service = $other_service->create(['name' => $mod['name'], 'user_defined' => TRUE]);

				$data = [
					'other_service_id' => $other_service->id,
					'accountant_id' => $accountant->id,
					'value' => $mod['value'],	
				];
				$model = new AccountantOtherService;
				$model->create($data);
			}
		}

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
		foreach ($input['other_services'] as $os_id => $mod) {
			$data = [
				'other_service_id' => $os_id,
				'accountant_id' => $accountant->id,
				'value' => $mod['value'],	
				'name' => $mod['name'],	
			];

			$os = OtherService::find($os_id);
			$os->name = $mod['name'];			
			$os->save();

			$model = new AccountantOtherService;
			$model->create($data);
		}

		return Redirect::to('practicedetails/services')
			->withInput()
			->with('message', 'Successfully saved Modules & Services.');
	}
}
