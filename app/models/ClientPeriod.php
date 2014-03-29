<?php

class ClientPeriod extends \Eloquent {
	protected $fillable = [
		'amount',
		'client_id',
		'period_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function period()
	{
		return $this->belongsTo('Period');
	}

}
