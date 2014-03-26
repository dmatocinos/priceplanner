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

	public static function getTaxReturnPricing($pricing_id = null)
	{
		$trs = DB::table('tax_returns')->get();	

		$data = [];
		foreach($trs as $tr) {
			$data[$tr->id] = NULL;
		}
		
		if ($pricing_id) {
			$res = DB::table('tax_return_pricings')->where('pricing_id', $pricing_id)->get();	

			$data = [];
			foreach ($res as $tax_return) {
				$data[$tax_return['id']] = $tax_return['name'];
			}
		}

		return $data;
		
	}

	

}
