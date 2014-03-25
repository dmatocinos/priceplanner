<?php

class TaxReturn extends \Eloquent {

	protected $fillable = [
		'name',
		'value',
	];

	public static $rules = [
		'name'	=> 'required',
		'value' => 'required|numeric',
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
