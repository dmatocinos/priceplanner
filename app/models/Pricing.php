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
	
	public static function getAll($user_id) 
	{
		return DB::select(
			"
				SELECT p.id, p.created_at, c.first_name, c.last_name, business_name, bt.name
				FROM pricings p 
				JOIN clients c ON p.client_id = c.id
				JOIN business_types bt ON c.business_type_id = bt.id
				WHERE p.user_id = :user_id
			", 
			array('user_id' => $user_id)
		);
	}
}
