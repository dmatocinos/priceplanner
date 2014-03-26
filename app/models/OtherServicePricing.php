<?php

class OtherServicePricing extends \Eloquent {

	protected $fillable = [
		'qty',
		'other_service_id',
		'pricing_id',
	];

	public static $rules = [
		'qty'	=> 'required|numeric',
	];

	public static function getOtherServicePricings($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$other_services = [];
		if ($pricing) {
			$oss = $pricing->other_service_pricings();
			foreach ($oss as $os) {
				$other_services[$os->module_id] = $os->qty;
			}
		}

		$default = DB::table('other_services')->get();	
		$data = [];		
		foreach ($default as $df) {
			$data[$df->id] = array_key_exists($df->id, $other_services) ? $other_services[$df->id] : NULL; 
		}

		return $data;
	}

}
