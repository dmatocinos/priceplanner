<?php

class AccountantModule extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'module_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function module()
	{
		return $this->belongsTo('Module');
	}

}
