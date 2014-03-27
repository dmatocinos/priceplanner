<?php

class Range extends \Eloquent {

	protected $fillable = [
		'lower',
		'upper',
		'range',
	];

	public static $rules = [
		'lower' => 'required|numeric',
		'upper' => 'required|numeric',
		'range' => 'required',
	];

	public static function getRanges()
	{
		$res = DB::table('ranges')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$name = $row->lower == $row->upper ? $row->lower : $row->lower . ' - ' . $row->upper;
			$name = $name == 50 ? '50+' : $name;
			$data[$row->id] = $name; 
		}

		return $data;
	}

}
