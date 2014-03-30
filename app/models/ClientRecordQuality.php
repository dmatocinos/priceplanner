<?php

class ClientRecordQuality extends \Eloquent {
	protected $fillable = [
		'percentage',
		'client_id',
		'record_quality_id',
		'accounting_type_id'
	];

	public $timestamps = false;

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function recordQuality()
	{
		return $this->belongsTo('RecordQuality');
	}

}
