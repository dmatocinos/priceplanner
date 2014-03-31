<?php

class AccountantTurnoverRange extends \Eloquent {
	protected $fillable = [
		'modifier',
		'accountant_id',
		'turnover_range_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function turnoverRange()
	{
		return $this->belongsTo('TurnoverRange');
	}

}
