<?php

class ClientVatReturn extends \Eloquent {
	protected $fillable = [
		'client_id',
		'value'
	];

	public $timestamps = false;
}
