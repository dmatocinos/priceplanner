<?php

class EmployeePayrollPricing extends \Eloquent {

	protected $fillable = [
		'employee_period_range_id',
		'pricing_id',
	];

	public static function getEmployeePeriodRanges($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$data = [];
		if ($pricing) {
			$ppricings = DB::select("
				SELECT epp.*, ep.* 
				FROM periods p
				JOIN employee_period_ranges epp ON p.id = epp.period_id
				LEFT JOIN employee_payroll_pricings ep ON ep.employee_period_range_id = epp.id 		
				WHERE ep.pricing_id = :pricing_id
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
