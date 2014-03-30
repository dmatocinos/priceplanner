<?php

class ClientEmployeePeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'employee_period_range_id'
	];

	public $timestamps = false;

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function employeePeriodRange()
	{
		return $this->belongsTo('EmployeePeriodRange');
	}

	public static function getClientEmployeePeriodRanges($client_id)
	{
		$res = DB::table('client_employee_period_ranges')
					->join('employee_period_ranges', 'employee_period_ranges.id', '=', 'client_employee_period_ranges.employee_period_range_id')
					->where('client_id', $client_id)
					->select('period_id', 'range_id', 'value')
					->get();	
		
		$data = [];
		foreach($res as $row) {
			$data[$row->range_id][$row->period_id] = $row->value;
		}
		
		return $data;

	}

}
