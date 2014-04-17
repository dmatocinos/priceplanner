<?php

class PracticeDetailsTaxesController extends PracticeDetailsController {
	protected $current_tab = "taxes";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_tax_returns->count()) {
			$accountant_tax_returns = DB::table('accountant_tax_returns')
				->where('accountant_id', $accountant->id)
				->lists('value', 'tax_return_id');
			$accountant_vat_returns = DB::table('accountant_vat_returns')
				->where('accountant_id', $accountant->id)
				->pluck('value');
			$edit = TRUE;
			$route = 'update';
		}
		else {
			$accountant_tax_returns = NULL;
			$accountant_vat_returns = null;
			$edit = FALSE;
			$route = 'store';
		}
		
		$form_data = [
				'tax_returns' => TaxReturn::getTaxReturns(),
				'accountant_tax_returns' => $accountant_tax_returns,
				'accountant_vat_returns' => $accountant_vat_returns,
				'edit'	=> $edit,
				'route' => 'practicedetails.taxes.' . $route,
				'accountant_id' => $accountant->id
		];
			
		$this->layout->content = View::make("pages.practicedetails.taxes", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		return $this->save($accountant, $input, 'created');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;

		AccountantTaxReturn::where('accountant_id', $accountant->id)->delete();
		AccountantVatReturn::where('accountant_id', $accountant->id)->delete();
		
		return $this->save($accountant, $input, 'updated');
	}
	
	protected function save($accountant, $input, $msg) 
	{
		// saving accountant tax returns
		foreach ($input['tax_returns'] as $id => $val) {
			$data = [
				'value' => $val,
				'accountant_id' => $accountant->id,
				'tax_return_id' => $id
			];
			$model = new AccountantTaxReturn;
			$model->create($data);
		}

		// saving VAT returns
		$model = new AccountantVatReturn;
		$model->create(['accountant_id' => $accountant->id, 'value' => $input['vat_returns']]);
		
		$route = isset($input['save_next_page']) ? 'practicedetails/bookkeeping' : 'practicedetails/taxes';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Taxes.');
	}
}
