<?php

class Client extends \Eloquent {

	protected $fillable = [
		'client_name',
		'business_name',
		'address',
		'period_start_date',
		'period_end_date',
		'user_id',
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

	public function business_type()
	{
		return $this->belongsTo('BusinessType');
	}
	
	public static function getAll($user_id) 
	{
		return DB::select(
			"
				SELECT *
				FROM clients c
				JOIN business_types bt ON c.business_type_id = bt.id
				WHERE c.user_id = :user_id
			", 
			array('user_id' => $user_id)
		);
	}
	
}
