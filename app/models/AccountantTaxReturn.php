<?php

class AccountantTaxReturn extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'tax_return_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function taxReturn()
	{
		return $this->belongsTo('TaxReturn');
	}

}
