<?php

class TurnoverRange extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];
	
	public static function getTurnoverRanges()
	{
		$res = DB::table('turnover_ranges')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = ($row->lower - $row->upper) 
					? NumFormatter::money($row->lower, '£') . ' - ' . NumFormatter::money($row->upper, '£')
					: NumFormatter::money($row->lower, '£'); 
		}

		return $data;
	}
}
