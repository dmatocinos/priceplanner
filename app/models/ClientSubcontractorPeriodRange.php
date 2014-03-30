<?php

class ClientSubcontractorPeriodRange extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'subcontractor_period_range_id'
	];

	public $timestamps = false;

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function subcontractorPeriodRange()
	{
		return $this->belongsTo('SubcontractorPeriodRange');
	}

	public static function getClientSubcontractorPeriodRanges($client_id)
	{
		$res = DB::table('client_subcontractor_period_ranges')
					->join('subcontractor_period_ranges', 'subcontractor_period_ranges.id', '=', 'client_subcontractor_period_ranges.subcontractor_period_range_id')
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
