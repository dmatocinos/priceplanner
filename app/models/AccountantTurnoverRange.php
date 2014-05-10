<?php

class AccountantTurnoverRange extends \Eloquent {
	protected $fillable = [
		'modifier',
		'lower',
		'upper',
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

	public static function getAccountantTurnoverRanges($accountant_id)
	{
		$res = DB::table('accountant_turnover_ranges')->where('accountant_id', $accountant_id)->get();	
		$data = range(1,15);
		foreach ($res as $num => $row) {
			$data[$num + 1] = [
				$row->id => [
				'lower' => $row->lower,
				'upper' => $row->upper,
				'modifier' => $row->modifier,
			]];
		}

		return $data;
	}

}
