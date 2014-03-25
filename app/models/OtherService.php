<?php

class OtherService extends \Eloquent {

	protected $fillable = [
		'name',
		'value',
	];

	public static $rules = [
		'name'	=> 'required',
		'value' => 'required|numeric',
	];

	public static function getOtherServices()
	{
		$res = DB::table('other_services')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

}
