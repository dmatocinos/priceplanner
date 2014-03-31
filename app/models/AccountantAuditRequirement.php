<?php

class AccountantAuditRequirement extends \Eloquent {
	protected $fillable = [
		'value',
		'accountant_id',
		'audit_requirement_id'
	];

	public $timestamps = false;

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function auditRequirement()
	{
		return $this->belongsTo('AuditRequirement');
	}
}
