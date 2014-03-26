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
		$data = [];
		if ($pricing) {
			$ospricings = DB::select("
				SELECT os.id as other_service_id, osp.*
				FROM other_services os
				LEFT JOIN other_service_pricings osp ON osp.other_service_id = os.id 		
				WHERE osp.pricing_id = :pricing_id
			", array('pricing_id' => $pricing_id));
			foreach ($ospricings as $row) {
				$data[$row->other_service_id] = $row->qty;
			}
		}
		else {
			$other_services = OtherService::all();
			foreach ($other_services as $row) {
				$data[$row->id] = NULL;
			}

		}

		return $data;
	}

}
