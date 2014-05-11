<?php

class AccountantPayrollRun extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'accountant_turnover_range_id',
		'type'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function accountantTurnoverRange()
	{
		return $this->belongsTo('AccountantTurnoverRange');
	}
	
	public static function getPayrollRunTurnoverRanges($accountant_id)
	{
		$res = DB::table('accountant_turnover_ranges')
				->leftJoin('accountant_payroll_runs', 'accountant_turnover_ranges.id', '=', 'accountant_payroll_runs.accountant_turnover_range_id')
				->select('accountant_turnover_ranges.id', 'accountant_payroll_runs.value', 'type')
				->where('accountant_turnover_ranges.accountant_id', $accountant_id)->get();	

		foreach ($res as $row) {
			$data[$row->type][$row->id] = $row->value ? : 0;
		}

		return $data;
	}
}
