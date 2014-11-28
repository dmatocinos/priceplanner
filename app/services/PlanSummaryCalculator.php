<?php

/**
 * Does the Price Planner calculations
 *
 * @package services
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/
class PlanSummaryCalculator {

	const VAT = .20;

	protected $client;
	protected $accountant;
	
	protected $summary_data = [
		
		'f11' => null,	
		'f15' => null,	
		'f7' => null,	
		'g5' => null,	
		'g7' => null,	
		'g8' => null,	
		'g11' => null,
		'i11' => null,
		'g15' => null,
		'g18' => null,
		'g19' => null,
		'g20' => null,
		'g22' => null,
		'g24' => null,
		'g25' => null,
		'modules' => [],
		'other_services' => [],
		'tax_returns' => [],
		'annual_fee' => null,
		'monthly_cost' => null,
		'discount' => null,
		'total_annual_fee' => null,
		'total_monthly_cost' => null,
		'total_annual_fee_tax' => null,
		'taxed_total_annual_fee' => null,
		'taxed_total_monthly_cost' => null,
		'annual_base_fee_per_emp_pay_run' => null,
		'annual_base_fee_per_sub_pay_run' => null,
		'annual_base_fee_per_emp_per_payroll_run' => null,
		'annual_base_fee_per_sub_per_payroll_run' => null,
		'total_annual_payroll' => null,
		'payment_frequency' => null,
		'amount_to_pay' => null,
		'vat' => null,

	];

	public function __construct(Pricing $pricing) 
	{
		$this->pricing = $pricing;
		$this->client = $pricing->client;
	}
	
	public function __get($name)
	{
		if (array_key_exists($name, $this->summary_data)) {
			$method_name = 'get' . studly_case($name) . 'Val';
			if (is_null($this->summary_data[$name]) || empty($this->summary_data[$name]) && method_exists($this, $method_name)) {
					return $this->$method_name();
			}
			return $this->summary_data[$name];
		}
	}

	public function getF7Val()
	{
		return DB::table('accountant_turnover_ranges')
				->where('accountant_id', $this->client->accountant_id)
				->whereRaw("{$this->pricing->turnovers} BETWEEN lower AND upper")
				->pluck('modifier') / 100;
	}

	public function getF11Val()
	{
		return DB::table('accountant_record_qualities')
				->where('accountant_id', $this->client->accountant_id)
				->where('accounting_type_id', $this->pricing->accounting_type_id)
				->where('record_quality_id', $this->pricing->record_quality_id)
				->pluck('percentage') / 100;
	}

	public function getF15Val()
	{
		return DB::table('accountant_audit_risks')
				->where('audit_risk_id', $this->pricing->audit_risk_id)
				->where('accountant_id', $this->client->accountant_id)
				->pluck('percentage') / 100;
	}

	public function getG5Val()
	{
		return (integer) DB::table('accountant_business_types')
					->where('business_type_id', $this->pricing->business_type_id)
					->where('accountant_id', $this->client->accountant_id)
					->pluck('base_fee');
	}

	public function getG7Val()
	{
		return ($this->g5 * $this->f7) * 1;
	}

	public function getG8Val()
	{
		return $this->g5 + $this->g7;
	}

	public function getG11Val()
	{
		return $this->g8 * $this->f11;
	}

	public function getI11Val()
	{
		return $this->g11 + $this->g8;
	}

	public function getG15Val()
	{
		$val = (integer) DB::table('accountant_audit_requirements')
					->where('accountant_id', $this->client->accountant_id)
					->where('audit_requirement_id', $this->pricing->audit_requirement_id)
					->pluck('value');

		return ($val ? ($val * $this->f15) : 0);
	}

	public function getG18Val()
	{
		// TODO : make this similar to other_services
		$val = DB::table('accountant_tax_returns')
					->join('tax_returns', 'tax_returns.id', '=', 'accountant_tax_returns.tax_return_id')
					->where('tax_return_id', 1)
					->where('accountant_id', $this->client->accountant_id)
					->pluck('value') * $this->pricing->corporate_tax_return;

		return $val;
	}

	public function getG19Val()
	{
		// TODO : make this similar to other_services
		$val = (integer) DB::table('accountant_tax_returns')
					->join('tax_returns', 'tax_returns.id', '=', 'accountant_tax_returns.tax_return_id')
					->where('tax_return_id', 2)
					->where('accountant_id', $this->client->accountant_id)
					->pluck('value') * $this->pricing->partnership_tax_return;
		return $val;
	}

	public function getG20Val()
	{
		// TODO : make this similar to other_services
		$val = (integer) DB::table('accountant_tax_returns')
					->join('tax_returns', 'tax_returns.id', '=', 'accountant_tax_returns.tax_return_id')
					->where('tax_return_id', 3)
					->where('accountant_id', $this->client->accountant_id)
					->pluck('value') * $this->pricing->self_assessment_tax_return;
		return $val;
	}

	public function getG22Val()
	{
        $type = $this->pricing->vat_rate_type ? $this->pricing->vat_rate_type : 'std_rate';
		$vat_val = (integer) DB::table('accountant_vat_returns')
					->where('accountant_id', $this->client->accountant_id)
					->pluck($type);
		return $this->pricing->vat_return * $vat_val;
	}

	public function getG24Val()
	{
		$hour_val = (integer) DB::table('accountant_bookkeepings')
					->where('accountant_id', $this->client->accountant_id)
					->pluck('hour_val');

		return $this->pricing->bookkeeping_hours * $hour_val;
	}

	public function getG25Val()
	{
		$day_val = (integer) DB::table('accountant_bookkeepings')
					->where('accountant_id', $this->client->accountant_id)
					->pluck('day_val');

		return $this->pricing->bookkeeping_days * $day_val;
	}
		
	public function getModulesVal()
	{
		$mp = DB::table('module_pricings')
				->join('modules', 'modules.id', '=', 'module_pricings.module_id')
				->join('accountant_modules', 'modules.id', '=', 'accountant_modules.module_id')
            			->select(DB::raw('modules.name, qty, qty * value AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->where('accountant_modules.accountant_id', $this->client->accountant_id)
				->orderBy('modules.id')
				->get();

		return $mp;
	}

	public function getOtherServicesVal()
	{
		$osp = DB::table('other_service_pricings')
				->join('other_services', 'other_services.id', '=', 'other_service_pricings.other_service_id')
				->join('accountant_other_services', 'other_services.id', '=', 'accountant_other_services.other_service_id')
            			->select(DB::raw('other_services.name, qty, qty * value AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->where('accountant_other_services.accountant_id', $this->client->accountant_id)
				->orderBy('other_services.id')
				->get();

		return $osp;
	}

	public function getTaxReturnsVal()
	{
		$trp = DB::table('tax_return_pricings')
				->join('tax_returns', 'tax_returns.id', '=', 'tax_return_pricings.tax_return_id')
				->join('accountant_tax_returns', 'tax_returns.id', '=', 'accountant_tax_returns.tax_return_id')
            			->select(DB::raw('tax_returns.name, qty, qty * value AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->where('accountant_tax_returns.accountant_id', $this->client->accountant_id)
				->orderBy('tax_returns.id')
				->get();

		return $trp;
	}

	public function getAnnualFeeVal()
	{
		$val = $this->i11 + $this->g15 + $this->g18 + $this->g19 + $this->g20 + $this->g22 + $this->g24 + $this->g25 + $this->total_annual_payroll;

		foreach($this->modules as $mod) {
			$val += $mod->value; 
		}

		foreach($this->other_services as $os) {
			$val += $os->value; 
		}

		foreach($this->tax_returns as $tr) {
			$val += $tr->value; 
		}

		return $val;
	}

	public function getVatVal()
	{
		return  $this->annual_fee * self::VAT;
	}

	public function getMonthlyCostVal()
	{
		return ($this->annual_fee / 12) * (1 + self::VAT);
	}

	public function getDiscountVal()
	{
		return (int) $this->pricing->discount / 100;
	}

	public function getTotalAnnualFeeVal()
	{
		return $this->annual_fee - ($this->annual_fee * $this->discount);
	}

	public function getTotalMonthlyCostVal()
	{
		return $this->total_annual_fee / 12;
	}

	public function getTotalAnnualFeeTaxVal()
	{
		return $this->total_annual_fee * self::VAT;
	}

	public function getTaxedTotalAnnualFeeVal()
	{
		return $this->total_annual_fee + $this->total_annual_fee_tax;
	}

	public function getTaxedTotalMonthlyCostVal()
	{
		return $this->taxed_total_annual_fee / 12;
	}
    
	public function getAnnualBaseFeePerEmpPayRunVal()
	{
		$base_fee = (integer) DB::table('accountant_pay_runs')
					->where('accountant_id', $this->client->accountant_id)
					->where('type', 'employee')
					->pluck('value');

		return $base_fee * $this->pricing->employee_pay_run_frequency * $this->pricing->no_of_employees;
	}

	public function getAnnualBaseFeePerEmpPerPayrollRunVal()
	{
		$rate = DB::table('accountant_pay_runs')
				->where('accountant_id', $this->client->accountant_id)
				->where('based_on', 'all_clients')
				->where('type', 'employee')
				->pluck('allclients_base_fee');
		if ( ! $rate) {
			$rate = (int) DB::table('accountant_turnover_ranges')
					->join('accountant_payroll_runs', 'accountant_turnover_ranges.id', '=', 'accountant_payroll_runs.accountant_turnover_range_id')
					->where('accountant_payroll_runs.accountant_id', $this->client->accountant_id)
					->where('type', 'employee')
					->whereRaw("{$this->pricing->turnovers} BETWEEN lower AND upper")
					->pluck('accountant_payroll_runs.value');
		}
	
		return $rate * $this->pricing->employee_pay_run_frequency * $this->pricing->no_of_employees;
	}

	public function getAnnualBaseFeePerSubPayRunVal()
	{
		$base_fee = (integer) DB::table('accountant_pay_runs')
					->where('accountant_id', $this->client->accountant_id)
					->where('type', 'subcontractor')
					->pluck('value');

		return $base_fee * $this->pricing->subcontractor_pay_run_frequency * $this->pricing->no_of_subcontractors;
	}

	public function getAnnualBaseFeePerSubPerPayrollRunVal()
	{
		$rate = DB::table('accountant_pay_runs')
				->where('accountant_id', $this->client->accountant_id)
				->where('based_on', 'all_clients')
				->where('type', 'subcontractor')
				->pluck('allclients_base_fee');
		if ( ! $rate) {
			$rate = (int) DB::table('accountant_turnover_ranges')
					->join('accountant_payroll_runs', 'accountant_turnover_ranges.id', '=', 'accountant_payroll_runs.accountant_turnover_range_id')
					->where('accountant_payroll_runs.accountant_id', $this->client->accountant_id)
					->where('type', 'subcontractor')
					->whereRaw("{$this->pricing->turnovers} BETWEEN lower AND upper")
					->pluck('accountant_payroll_runs.value');
		}

		return $rate * $this->pricing->subcontractor_pay_run_frequency * $this->pricing->no_of_subcontractors;
	}

	public function getTotalAnnualPayrollVal()
	{
		return $this->annual_base_fee_per_emp_pay_run + $this->annual_base_fee_per_emp_per_payroll_run
			+ $this->annual_base_fee_per_sub_pay_run + $this->annual_base_fee_per_sub_per_payroll_run;
	}

	public function getPaymentFrequencyVal()
	{
		$freq = [
			'52' => 'weekly',
			'26' => 'fortnightly',
			'13' => 'four-weekly',
			'12' => 'monthly',
			'1' => 'annually',
		];
		return $freq[$this->pricing->employee_pay_run_frequency];
	}

	public function getAmountToPay()
	{
		return $this->annual_fee / (int) $this->pricing->employee_pay_run_frequency;
	}

}
