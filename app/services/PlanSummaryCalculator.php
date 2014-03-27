<?php

/**
 * Does the Price Planner calculations
 *
 * @package services
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/
class PlanSummaryCalculator {

	protected $pricing;
	protected $business_types;
	
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

	];

	public function __construct(Pricing $pricing) 
	{
		$this->pricing = $pricing;
		$this->business_types = DB::table('business_types')->lists('base_fee', 'id');
		$this->turnover_ranges = DB::table('turnover_ranges')->get();
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
		return DB::table('turnover_ranges')
					->whereRaw("{$this->pricing->turnovers} BETWEEN lower AND UPPER")
					->pluck('modifier') / 100;
	}

	public function getF11Val()
	{
		return DB::table('record_qualities')
				->where('accounting_type_id', $this->pricing->accounting_type_id)
				->where('id', $this->pricing->record_quality_id)
				->pluck('percentage') / 100;
	}

	public function getF15Val()
	{
		return DB::table('audit_risks')
				->where('id', $this->pricing->audit_risk_id)
				->pluck('percentage') / 100;
	}

	public function getG5Val()
	{
		return (integer) DB::table('business_types')
					->where('id', $this->pricing->business_type_id)
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
		$val = (integer) DB::table('audit_requirements')
					->where('id', $this->pricing->audit_requirement_id)
					->pluck('value');

		return ($val ? ($val * $this->f15) : 0);
	}

	public function getG18Val()
	{
		// TODO : make this similar to other_services
		$val = (integer) DB::table('tax_returns')
					->where('name', 'Corporation Tax Return')
					->pluck('value') * $this->pricing->corporate_tax_return;

		return $val;
	}

	public function getG19Val()
	{
		// TODO : make this similar to other_services
		$val = (integer) DB::table('tax_returns')
					->where('name', 'Partnership Tax Return')
					->pluck('value') * $this->pricing->partnership_tax_return;
		return $val;
	}

	public function getG20Val()
	{
		// TODO : make this similar to other_services
		$val = (integer) DB::table('tax_returns')
					->where('name', 'Self-Assessment Return')
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
				->join('periods', 'employee_period_ranges.period_id', '=', 'periods.id')
				->join('ranges', 'employee_period_ranges.range_id', '=', 'ranges.id')
            			->select(DB::raw('periods.name, ranges.range, employee_period_ranges.value * amount AS value'))
				->where('pricing_id', $this->pricing->id)
				->orderBy('period_id')
				->get();

		return $epp;
	}

	public function getScPayrollVal()
	{
		$spp = DB::table('sc_payroll_pricings')
				->join('subcontractor_period_ranges', 'sc_payroll_pricings.sc_period_range_id', '=', 'subcontractor_period_ranges.id')
				->join('periods', 'subcontractor_period_ranges.period_id', '=', 'periods.id')
				->join('ranges', 'subcontractor_period_ranges.range_id', '=', 'ranges.id')
            			->select(DB::raw('periods.name, ranges.range, subcontractor_period_ranges.value * amount AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->orderBy('period_id')
				->get();
		return $spp;
	}

	public function getModulesVal()
	{
		$mp = DB::table('module_pricings')
				->join('modules', 'modules.id', '=', 'module_pricings.module_id')
            			->select(DB::raw('modules.name, qty, qty * value AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->orderBy('module_id')
				->get();

		return $mp;
	}

	public function getOtherServicesVal()
	{
		$osp = DB::table('other_service_pricings')
				->join('other_services', 'other_services.id', '=', 'other_service_pricings.other_service_id')
            			->select(DB::raw('other_services.name, qty, qty * value AS value'))
				->where( 'pricing_id', $this->pricing->id)
				->orderBy('other_service_id')
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

}
