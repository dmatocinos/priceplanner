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
		'discount',
		'no_of_employees',
		'no_of_subcontractors',
		'employee_pay_run_frequency',
		'subcontractor_pay_run_frequency',
	];

	public static $rules = array(
		'turnovers' => 'required|numeric',
		'corporate_tax_return' => 'required|numeric',
		'partnership_tax_return' => 'required|numeric',
		'self_assessment_tax_return' => 'required|numeric',
		'vat_return' => 'required|numeric',
		'bookkeeping_hours' => 'required|numeric',
		'bookkeeping_days' => 'required|numeric',
		'discount' => 'required|numeric',  
		'no_of_employees' => 'required|numeric',  
		'employee_pay_run_frequency' => 'required|numeric',  
		'no_of_subcontractors' => 'required|numeric',  
		'subcontractor_pay_run_frequency' => 'required|numeric',  
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
