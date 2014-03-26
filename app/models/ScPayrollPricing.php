<?php

class ScPayrollPricing extends \Eloquent {

	protected $fillable = [
		'sc_period_range_id',
		'pricing_id',
	];

	public static function getScPeriodRanges($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$data = [];
		if ($pricing) {
			$ppricings = DB::select("
				SELECT spp.*, sp.* 
				FROM periods p
				JOIN subcontractor_period_ranges spp ON p.id = spp.period_id
				LEFT JOIN sc_payroll_pricings sp ON sp.sc_period_range_id = spp.id 		
				WHERE sp.pricing_id = :pricing_id
			", array('pricing_id' => $pricing_id));
			foreach ($ppricings as $pp) {
				$data[$pp->period_id]['range_id'] = $pp->range_id;
			}
		}
		else {
			$periods = Period::all();
			foreach ($periods as $pp) {
				$data[$pp->id]['range_id'] = NULL;
			}

		}

		return $data;
	}

}
