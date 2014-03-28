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
		'bookkeeping_day_val',
		'discount',
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
		'bookkeeping_day_val' => 'required|numeric',  
		'discount' => 'required|numeric',  
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
		return $this->hasMany('EmployeePayrollPricing');
	}

	public function sc_payroll_pricings()
	{
		return $this->hasMany('ScPayrollPricing');
	}

	public function modulePricings()
	{
		return $this->hasMany('ModulePricing');
	}

	public function otherServicePricings()
	{
		return $this->hasMany('OtherServicePricing');
	}

	public function module()
	{
	}
}
