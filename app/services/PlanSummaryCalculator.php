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
		'employee_payroll' => [],
		'sc_payroll' => [],
		'modules' => [],
		'other_services' => [],
		'annual_fee' => null,
		'monthly_cost' => null,
		'discount' => null,
		'total_annual_fee' => null,
		'total_monthly_cost' => null,
		'total_annual_fee_tax' => null,
		'taxed_total_annual_fee' => null,
		'taxed_total_monthly_cost' => null,

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
				->join('turnover_ranges', 'turnover_ranges.id', '=', 'accountant_turnover_ranges.turnover_range_id')
				->where('accountant_id', $this->client->accountant_id)
				->whereRaw("{$this->pricing->turnovers} BETWEEN lower AND UPPER")
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
		return $this->pricing->vat_return * 100;
	}

	public function getG24Val()
	{
		return $this->pricing->bookkeeping_hours * $this->pricing->bookkeeping_hour_val;
	}

	public function getG25Val()
	{
		return $this->pricing->bookkeeping_days * $this->pricing->bookkeeping_day_val;
	}

	public function getEmployeePayrollVal()
	{
		$epp = DB::table('employee_payroll_pricings')
				->join('employee_period_ranges', 'employee_payroll_pricings.employee_period_range_id', '=', 'employee_period_ranges.id')
				->join('accountant_employee_period_ranges', 'accountant_employee_period_ranges.employee_period_range_id', '=', 'employee_period_ranges.id')
				->join('periods', 'employee_period_ranges.period_id', '=', 'periods.id')
				->join('ranges', 'employee_period_ranges.range_id', '=', 'ranges.id')
            			->select(DB::raw('periods.name, ranges.range, accountant_employee_period_ranges.value * amount AS value'))
				->where('accountant_employee_period_ranges.accountant_id', $this->client->accountant_id)
				->where('pricing_id', $this->pricing->id)
				->orderBy('period_id')
				->get();

		return $epp;
	}

	public function getScPayrollVal()
	{
		$spp = DB::table('sc_payroll_pricings')
				->join('subcontractor_period_ranges', 'sc_payroll_pricings.sc_period_range_id', '=', 'subcontractor_period_ranges.id')
				->join('accountant_subcontractor_period_ranges', 'accountant_subcontractor_period_ranges.subcontractor_period_range_id', '=', 'subcontractor_period_ranges.id')
				->join('periods', 'subcontractor_period_ranges.period_id', '=', 'periods.id')
				->join('ranges', 'subcontractor_period_ranges.range_id', '=', 'ranges.id')
            			->select(DB::raw('periods.name, ranges.range, accountant_subcontractor_period_ranges.value * amount AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->where('accountant_subcontractor_period_ranges.accountant_id', $this->client->accountant_id)
				->orderBy('period_id')
				->get();
		return $spp;
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

	public function getAnnualFeeVal()
	{
		$val = $this->i11 + $this->g15 + $this->g18 + $this->g19 + $this->g20 + $this->g22 + $this->g24 + $this->g25;

		foreach($this->employee_payroll as $ep) {
			$val += $ep->value; 
		}

		foreach($this->sc_payroll as $sp) {
			$val += $sp->value; 
		}

		foreach($this->modules as $mod) {
			$val += $mod->value; 
		}

		foreach($this->other_services as $os) {
			$val += $os->value; 
		}

		return $val;
	}

	public function getMonthlyCostVal()
	{
		return $this->annual_fee / 12;
	}

	public function getDiscountVal()
	{
		return $this->pricing->discount / 100;
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

}
