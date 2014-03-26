<?php

class Period extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getPeriods()
	{
		$res = DB::table('periods')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

}
