<?php

class AccountantSubcontractorPeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'subcontractor_period_range_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function subcontractorPeriodRange()
	{
		return $this->belongsTo('SubcontractorPeriodRange');
	}

	public static function getAccountantSubcontractorPeriodRanges($accountant_id)
	{
		$res = DB::table('accountant_subcontractor_period_ranges')
					->join('subcontractor_period_ranges', 'subcontractor_period_ranges.id', '=', 'accountant_subcontractor_period_ranges.subcontractor_period_range_id')
					->where('accountant_id', $accountant_id)
					->select('period_id', 'range_id', 'accountant_subcontractor_period_ranges.value')
					->get();	
		
		$data = [];
		foreach($res as $row) {
			$data[$row->range_id][$row->period_id] = $row->value;
		}
		
		return $data;

	}


}
