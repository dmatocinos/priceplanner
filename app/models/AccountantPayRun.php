<?php

class AccountantPayRun extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'based_on',
		'allclients_base_fee',
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

}
