<?php

class EmployeePeriodRange extends \Eloquent {

	protected $fillable = [
		'range_id',
		'period_id',
	];

	public static $rules = [
	];

	public static function getEmployeePeriodRanges()
	{
		$res = DB::table('employee_period_ranges')->get();	
		return $res;
	}

}
