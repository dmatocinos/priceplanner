<?php

class ClientModule extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'module_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function module()
	{
		return $this->belongsTo('Module');
	}

}
