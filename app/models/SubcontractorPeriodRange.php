<?php

class SubcontractorPeriodRange extends \Eloquent {

	protected $fillable = [
		'range_id',
		'period_id',
	];

	public static $rules = [
	];

	public static function getSubcontractorPeriodRanges()
	{
		$res = DB::table('subcontractor_period_ranges')->get();	
		return $res;
	}

}
