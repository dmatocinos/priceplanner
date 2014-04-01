<?php

use Carbon\Carbon;

class Client extends \Eloquent {

	protected $fillable = [
		'client_name',
		'business_name',
		'address',
		'period_start_date',
		'period_end_date',
		'accountant_id',
	];

	public static $rules = array(
		'client_name' => 'required',
		'business_name' => 'required',
		'address' => 'required',
		'period_start_date' => 'required',
		'period_end_date' => 'required',
	);

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function pricing()
	{
		return $this->hasOne('Pricing');
	}

	public function getPeriodStartDateAttribute()
	{
		return $this->asDateTime($this->attributes['period_start_date']);
	}

	public function getPeriodEndDateAttribute()
	{
		return $this->asDateTime($this->attributes['period_end_date']);
	}

	public function getAccountingPeriodAttribute()
	{
		return "{$this->period_start_date->toFormattedDateString()} - {$this->period_end_date->toFormattedDateString()}";
	}

	public static function getAll($accountant_id) 
	{
		return DB::select(
			"
				SELECT *
				FROM clients c
				WHERE c.accountant_id = :accountant_id
			", 
			array('accountant_id' => $accountant_id)
		);
	}
	
}
