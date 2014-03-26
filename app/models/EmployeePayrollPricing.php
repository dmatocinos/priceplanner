<?php

class EmployeePayrollPricing extends \Eloquent {

	protected $fillable = [
		'employee_period_range_id',
		'pricing_id',
	];

	public static function getEmployeePeriodRanges($pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$epps = [];
		if ($pricing) {
			$pps = $pricing->employee_payroll_pricings();
			foreach ($pps as $pp) {
				$epps[] = $pp->employee_period_range_id;
			}
		}

		$eprs = DB::table('employee_period_ranges')->get();	
		
		$data = [];		
		foreach ($eprs as $epr) {
			$data[$epr->period_id]['range_id'] = in_array($epr, $epps) ? $epr->range_id : NULL; 
		}

		return $data;
	}

}
