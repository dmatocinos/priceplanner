<?php

class AccountantEmployeePeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'employee_period_range_id'
	];

	public $timestamps = false;

	public function Accountant()
	{
		return $this->belongsTo('Accountant`');
	}

	public function employeePeriodRange()
	{
		return $this->belongsTo('EmployeePeriodRange');
	}

	public static function getAccountantEmployeePeriodRanges($accountant_id)
	{
		$res = DB::table('accountant_employee_period_ranges')
					->join('employee_period_ranges', 'employee_period_ranges.id', '=', 'accountant_employee_period_ranges.employee_period_range_id')
					->where('accountant_id', $accountant_id)
					->select('period_id', 'range_id', 'value')
					->get();	
		
		$data = [];
		foreach($res as $row) {
			$data[$row->range_id][$row->period_id] = $row->value;
		}
		
		return $data;

	}

}
