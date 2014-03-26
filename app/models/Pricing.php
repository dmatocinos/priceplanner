<?php

class Pricing extends \Eloquent {
	protected $fillable = [
		'user_id',
		'client_id',
		'accountanting_type_id',
		'turnover',
		'audit_requirement_id',
		'audit_risk_id',
		'corporate_tax_return',
		'partnership_tax_return',
		'self_assessment_tax_return',
		'vat_return',
		'bookkeeping_hours',
		'bookkeeping_days',
		'bookkeeping_hour_val',
		'bookkeeping_day_val'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}
	
	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function employee_payroll_pricings()
	{
		return $this->hasMany('employee_payroll_pricings');
	}

	public function sc_payroll_pricings()
	{
		return $this->hasMany('sc_payroll_pricings');
	}

	public function module_pricings()
	{
		return $this->hasMany('module_pricings');
	}

	public function other_service_pricings()
	{
		return $this->hasMany('other_service_pricings');
	}
}
