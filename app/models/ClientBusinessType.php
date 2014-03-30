<?php

class ClientBusinessType extends \Eloquent {
	protected $fillable = [
		'base_fee',
		'client_id',
		'business_type_id'
	];

	public $timestamps = false;

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function businessType()
	{
		return $this->belongsTo('BusinessType');
	}


}
