<?php

class ScPayrollPricing extends \Eloquent {

	protected $fillable = [
		'sc_period_range_id',
		'pricing_id',
	];

	public static function getScPeriodRanges($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$spps = [];
		if ($pricing) {
			$pps = $pricing->sc_payroll_pricings();
			foreach ($pps as $pp) {
				$spps[] = $pp->sc_period_range_id;
			}
		}

		$sprs = DB::table('subcontractor_period_ranges')->get();	
		$data = [];		
		foreach ($sprs as $spr) {
			$data[$spr->period_id]['range_id'] = in_array($spr->id, $spps) ? $spr->range_id : NULL; 
		}

		return $data;
	}

}
