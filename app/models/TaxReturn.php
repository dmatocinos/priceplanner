<?php

class TaxReturn extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getTaxReturns()
	{
		$res = DB::table('tax_returns')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}
}
