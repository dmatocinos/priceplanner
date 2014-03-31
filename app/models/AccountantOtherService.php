<?php

class AccountantOtherService extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'other_service_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function otherService()
	{
		return $this->belongsTo('OtherService');
	}

}
