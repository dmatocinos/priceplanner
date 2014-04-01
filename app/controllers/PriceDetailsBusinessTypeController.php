<?php

class PriceDetailsBusinessTypeController extends BaseController {

	public function create($accountant_id) 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$accountant = Accountant::find($accountant_id);

		$form_data = [
				'business_types' => BusinessType::getBusinessTypes(),
				'edit'	=> FALSE,
				'route' => 'pricedetails.businesstypes.store',
				'accountant_id' => $accountant->id,
		];
		
		$this->layout->content = View::make("pages.pricedetails.businesstypes", $form_data);
	}

	public function edit($accountant_id)
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$accountant = Accountant::find($accountant_id);

		$form_data = [
				'business_types' => BusinessType::getBusinessTypes(),
				'accountant_business_types' => DB::table('accountant_business_types')
								->where('accountant_id', $accountant->id)
								->lists('base_fee', 'business_type_id'),
				'edit'	=> TRUE,
				'has_fee_levels' => $accountant->hasOne('AccountantBusinessType')->getResults(),
				'route' => 'pricedetails.businesstypes.update',
				'accountant_id' => $accountant->id
		];

		$this->layout->content = View::make("pages.pricedetails.businesstypes", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = Accountant::find($input['accountant_id']);
		
		// saving accountant business_types
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant->id,
				'business_type_id' => $id
			];
			$model = new AccountantBusinessType;
			$model->create($data);
		}
		
		$route = isset($input['save_next_page']) 
		       ? 'pricedetails/turnoverranges/create/' . $accountant->id
		       : 'pricedetails/businesstypes/edit/' . $accountant->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully created business types price details.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = Accountant::find($input['accountant_id']);

		AccountantBusinessType::where('accountant_id', $accountant->id)->delete();

		// saving accountant business_types
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant->id,
				'business_type_id' => $id
			];
			$model = new AccountantBusinessType;
			$model->create($data);
		}
 			

		$route = isset($input['save_next_page']) 
		       ? 'pricedetails/turnoverranges/create/' . $accountant->id
		       : 'pricedetails/businesstypes/edit/' . $accountant->id;

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated business types details.');
	}

}
