<?php

class AccountantAuditRisk extends \Eloquent {
	protected $fillable = [
		'percentage',
		'accountant_id',
		'audit_risk_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function auditRisk()
	{
		return $this->belongsTo('AuditRisk');
	}

}
