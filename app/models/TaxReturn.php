<?php

class TaxReturn extends \Eloquent {

	protected $fillable = [
		'name',
		'user_defined',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public $timestamps = false;

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

	public static function getId($name)
	{
		return DB::table('tax_returns')->where('name', $name)->pluck('id');
	}

	public static function getOtherTaxReturns($accountant_id = null, $user_defined = null)
	{
		$table = DB::table('tax_returns') ;

		if (! is_null($accountant_id) && is_null($user_defined)) {
			$table
				->leftjoin('accountant_tax_returns', 'accountant_tax_returns.tax_return_id', '=', 'tax_returns.id')
				->select('accountant_tax_returns.tax_return_id as id', 'name', 'user_defined', 'value', 'accountant_id', 'tax_returns.id as tax_return_id')
				->where('accountant_id', $accountant_id);
		}

		if ( ! is_null($user_defined) && $user_defined) {
			$table
				->where('user_defined', true);
		}		
		else if ( ! is_null($user_defined) && $user_defined == false) {
			$table
				->where('user_defined', false);
		}
		else  {
			$table
				->orWhereNull('user_defined');
		}
		$table->orderBy('user_defined');

		$res = $table->get();	
		$data = [];

		foreach ($res as $row)
		{
			$id = isset($row->tax_return_id) ? $row->tax_return_id : $row->id; 
			$data[$id] = $row->name; 
		}
		return $data;
	}
}
