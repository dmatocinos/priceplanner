<?php

class Client extends \Eloquent {
	protected $fillable = [
		'first_name',
		'middle_name',
		'last_name',
		'business_name',
		'address',
		'period_start_date',
		'period_end_date',
		'user_id',
		'business_type_id'	
	];

	
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
