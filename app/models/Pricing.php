<?php

class Pricing extends \Eloquent {
	protected $fillable = [
		'client_id',
		'business_type_id',
		'accounting_type_id',
		'record_quality_id',
		'turnovers',
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

	public static $rules = array(
		'turnovers' => 'required|numeric',
		'corporate_tax_return' => 'required|numeric',
		'partnership_tax_return' => 'required|numeric',
		'self_assessment_tax_return' => 'required|numeric',
		'vat_return' => 'required|numeric',
		'bookkeeping_hours' => 'required|numeric',
		'bookkeeping_days' => 'required|numeric',
		'bookkeeping_hour_val' => 'required|numeric',
		'bookkeeping_day_val' => 'required|numeric'  
	);

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
