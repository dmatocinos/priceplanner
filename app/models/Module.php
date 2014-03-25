<?php

class Module extends \Eloquent {

	protected $fillable = [
		'name',
		'value',
	];

	public static $rules = [
		'name'	=> 'required',
		'value' => 'required|numeric',
	];

	public static function getModules()
	{
		$res = DB::table('modules')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

}
