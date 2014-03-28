<?php

class ModulePricing extends \Eloquent {

	protected $fillable = [
		'qty',
		'module_id',
		'pricing_id',
	];

	public static $rules = [
		'qty'	=> 'required|numeric',
	];

	public function module()
	{
		return $this->belongsTo('Module');
	}

	public static function getModulePricings($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$data = [];
		if ($pricing) {
			$mpricings = DB::select("
				SELECT m.id as module_id, mp.*
				FROM modules m
				LEFT JOIN module_pricings mp ON mp.module_id = m.id 		
				WHERE mp.pricing_id = :pricing_id
			", array('pricing_id' => $pricing_id));
			foreach ($mpricings as $row) {
				$data[$row->module_id] = $row->qty;
			}
		}
		else {
			$modules = Module::all();
			foreach ($modules as $row) {
				$data[$row->id] = NULL;
			}

		}
		return $data;
	}

}
