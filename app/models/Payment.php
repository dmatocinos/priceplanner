<?php

class Payment extends \Eloquent {

	protected $fillable = [	
		'user_id',
		'amount',
		'transaction_id',
		'order_time'
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

}
