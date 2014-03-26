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
		return $res;
	}

}
