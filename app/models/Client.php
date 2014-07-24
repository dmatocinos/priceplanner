<?php

use Carbon\Carbon;

class Client extends Eloquent {

	protected $softDelete = true;

	protected $client;

	protected $fillable = [
		'accountant_id',
		'client_id'
	];

	public static $rules = array(
		'client_name' => 'required',
		'business_name' => 'required',
		'street_address'	=> 'required',
		'city_address'	=> 'required',
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
		$client = $this->getClient();
		return $this->asDateTime($client->period_start_date);
	}

	public function getPeriodEndDateAttribute()
	{
		$client = $this->getClient();
		return $this->asDateTime($client->period_end_date);
	}

	public function getClientNameAttribute($value)
	{
		$client = $this->getClient();
		return $client->contact_name;
	}

	public function getBusinessNameAttribute($value)
	{
		$client = $this->getClient();
		return $client->business_name;
	}

	public function getStreetAddressAttribute($value)
	{
		$client = $this->getClient();
		return $client->address_1;
	}

	public function getCityAddressAttribute($value)
	{
		$client = $this->getClient();
		return $client->county;
	}

	public function getCountryAddressAttribute($value)
	{
		$client = $this->getClient();
		return $client->country;
	}

	public function getZipAdressAttribute($value)
	{
		$client = $this->getClient();
		return $client->postcode;
	}

	public function getAccountingPeriodAttribute()
	{
		return "{$this->period_start_date->toFormattedDateString()} - {$this->period_end_date->toFormattedDateString()}";
	}

	public static function getAll($accountant_id) 
	{
		return Client::where('accountant_id', '=', $accountant_id)
				->whereRaw('deleted_at IS NULL')
				->where('client_id', '<>', 0)
				->get();
	}

	public function getClient()
	{
		return PracticeProClient::find($this->client_id);
	}
	
}
