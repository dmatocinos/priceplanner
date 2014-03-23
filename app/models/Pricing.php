<?php

class Pricing extends \Eloquent {
	protected $fillable = [
		'user_id',
		'client_id',
		'accountant_id',
		'accountanting_type_id',
		'turnover_range_id',
		'audit_requirement_id',
		'audit_risk_id',
		'vat_return',
		'bookkeeping_hours',
		'bookkeeping_days',
		'bookkeeping_hour_val',
		'bookkeeping_day_val'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}
	
	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}
}
