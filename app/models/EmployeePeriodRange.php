<?php

class EmployeePeriodRange extends \Eloquent {

	protected $fillable = [
		'value',
		'range_id',
		'period_id',
	];

	public static $rules = [
		'value'	=> 'required',
	];

	public static function getEmployeePeriodRanges()
	{
		$res = DB::table('employee_period_ranges')->get();	
		return $res;
	}

}
