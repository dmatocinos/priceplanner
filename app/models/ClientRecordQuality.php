<?php

class ClientRecordQuality extends \Eloquent {
	protected $fillable = [
		'percentage',
		'client_id',
		'record_quality_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function recordQuality()
	{
		return $this->belongsTo('RecordQuality');
	}

}
