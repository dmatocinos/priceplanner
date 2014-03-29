<?php

class ClientAuditRequirement extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'audit_requirement_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function auditRequirement()
	{
		return $this->belongsTo('AuditRequirement');
	}
}
