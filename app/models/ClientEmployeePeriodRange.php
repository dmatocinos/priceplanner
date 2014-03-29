<?php

class ClientEmployeePeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'employee_period_range'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function employeePeriodRange()
	{
		return $this->belongsTo('EmployeePeriodRange');
	}

}
