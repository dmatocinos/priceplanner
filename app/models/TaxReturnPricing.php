<?php

class TaxReturnPricing extends \Eloquent {

	protected $fillable = [
		'qty',
		'tax_return_id',
		'pricing_id'
	];

	public static $rules = [
		'qty' => 'required|numeric',
	];

	public function pricings() 
	{
		return $this->hasMany('Pricing');
	}

	public static function getTaxReturnPricing($pricing_id)
	{
		$res = DB::table('audit_requirements')->get();	

		$data = [];
		foreach ($tax_returns as $tax_return) {
			if ($tax_return['tax_return_id']) {
				$data[$tax_return['id']] = $tax_return['name'];
			}
			else {
				$data[$tax_return['id']] = NULL;
			}
		}

		return $data;
	}

	

}
