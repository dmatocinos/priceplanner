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
		return $res;
	}

}
