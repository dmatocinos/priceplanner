<?php

class AccountantBusinessType extends \Eloquent {
	protected $fillable = [
		'base_fee',
		'accountant_id',
		'business_type_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function businessType()
	{
		return $this->belongsTo('BusinessType');
	}


}
