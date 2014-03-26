<?php

class SubcontractorPeriodRange extends \Eloquent {

	protected $fillable = [
		'value',
		'range_id',
		'period_id',
	];

	public static $rules = [
		'value'	=> 'required',
	];

	public static function getSubcontractorPeriodRanges()
	{
		$res = DB::table('subcontractor_period_ranges')->get();	
		return $res;
	}

}
