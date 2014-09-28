<?php

class AccountantVatReturn extends \Eloquent {
	protected $fillable = [
		'accountant_id',
		'std_rate',
		'flat_rate',
	];

	public $timestamps = false;
}
