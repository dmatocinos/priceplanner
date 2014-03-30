<?php

class ClientTurnoverRange extends \Eloquent {
	protected $fillable = [
		'modifier',
		'client_id',
		'turnover_range_id'
	];

	public $timestamps = false;

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function turnoverRange()
	{
		return $this->belongsTo('TurnoverRange');
	}

}
