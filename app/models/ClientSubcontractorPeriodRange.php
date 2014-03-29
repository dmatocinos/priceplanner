<?php

class ClientSubcontractorPeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'subcontractor_period_range'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function subcontractorPeriodRange()
	{
		return $this->belongsTo('SubcontractorPeriodRange');
	}


}
