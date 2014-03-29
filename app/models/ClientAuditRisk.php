<?php

class ClientAuditRisk extends \Eloquent {
	protected $fillable = [
		'percentage',
		'client_id',
		'audit_risk_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function auditRisk()
	{
		return $this->belongsTo('AuditRisk');
	}

}
