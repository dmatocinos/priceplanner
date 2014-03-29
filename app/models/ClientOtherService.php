<?php

class ClientOtherService extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'other_service_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function otherService()
	{
		return $this->belongsTo('OtherService');
	}

}
