<?php

class AccountantVatReturn extends \Eloquent {
	protected $fillable = [
		'accountant_id',
		'value'
	];

	public $timestamps = false;
}
