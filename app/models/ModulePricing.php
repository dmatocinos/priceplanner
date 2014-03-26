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

	public static function getModulePricings($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$modules = [];
		if ($pricing) {
			$mods = $pricing->module_pricings();
			foreach ($mods as $mod) {
				$modules[$mod->module_id] = $mod->qty;
			}
		}

		$default = DB::table('modules')->get();	
		$data = [];		
		foreach ($default as $df) {
			$data[$df->id] = array_key_exists($df->id, $modules) ? $modules[$df->id] : NULL; 
		}

		return $data;
	}

}
