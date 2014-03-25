<?php

class AccountingType extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getAccountingTypes()
	{
		$accountant_types = DB::table('accounting_types')->get();	
		$data = [];
		foreach ($accountant_types as $accountant_type)
		{
			$data[$accountant_type->id] = $accountant_type->name; 
		}

		return $data;
	}

}
