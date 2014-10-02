<?php

use Carbon\Carbon;

class Client extends Eloquent {

	protected function getDateFormat()
	{
		return 'M j Y';
	}

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
		if($client = $this->getClient()) {
			return $this->asDateTime($client->period_start_date);
		}
		return null;
	}

	public function getPeriodEndDateAttribute()
	{
		if($client = $this->getClient()) {
			return $this->asDateTime($client->period_end_date);
		}
		return null;
	}

	public function getClientNameAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->contact_name;
		}
		return null;
	}

	public function getBusinessNameAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->business_name;
		}
		return null;
	}

	public function getStreetAddressAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->address_1;
		}
		return null;
	}

	public function getCityAddressAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->county;
		}
		return null;
	}

	public function getCountryAddressAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->country;
		}
		return null;
	}

	public function getZipAdressAttribute($value)
	{
		if($client = $this->getClient()) {
			return $client->postcode;
		}
		return null;
	}

	public function getAccountingPeriodAttribute()
	{
		return $this->period_start_date->setTimezone("Europe/London")->format("j M Y") . " - " . $this->period_end_date->setTimezone("Europe/London")->format("j M Y");
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
