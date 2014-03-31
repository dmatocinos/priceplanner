<?php

class AccountantRecordQuality extends \Eloquent {
	protected $fillable = [
		'percentage',
		'accountant_id',
		'record_quality_id',
		'accounting_type_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function recordQuality()
	{
		return $this->belongsTo('RecordQuality');
	}

}
