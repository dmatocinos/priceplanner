<?php

class AccountantPayRun extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'based_on',
		'allclients_base_fee',
		'type'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public static function getPayruns($accountant)
	{
		$payruns = $accountant->accountant_pay_run;
		
		$data = [];
		foreach ($payruns as $payrun) {
			$data[$payrun->type] = $payrun->getAttributes();
		}

		return $data;
	}

}
