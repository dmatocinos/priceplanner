<?php

class AccountantBookkeeping extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'hour_val',
		'day_val',
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

}
