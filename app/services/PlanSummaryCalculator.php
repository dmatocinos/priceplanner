<?php

/**
 * Does the Price Planner calculations
 *
 * @package services
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/
class PlanSummaryCalculator {

	protected $pricing;
	
	protected $summary_data = [
		
		'i11' => null,
		'i15' => null,
		'i17' => null,
		'i18' => null,
		'i19' => null,
		'i20' => null,
		'i22' => null,
		'i24' => null,
		'i25' => null,
		'employee_payroll' => [],
		'sc_payroll' => [],
		'modules' => [],
		'other_services' => [],
		'i69' => null,
		'i71' => null,
		'i73' => null,
		'i75' => null,
		'i77' => null,

	];

	public function __contruct(Pricing $pricing) 
	{
		$this->prising = $pricing;
	}
	
	public function __get($name)
	{
		if (array_key_exists($name, $this->summary_data)) {
			$method_name = 'get' . studly_case($name) . 'Val';
			if (is_null($this->summary_data[$name]) && method_exists($this, $method_name)) {
					return $this->$method_name();
			}
			return $this->summary_data[$name];
		}
	}

	public function getI11Val()
	{
	}

	public function getModulesVal()
	{
		return [];
	}

	public function getOtherServicesVal()
	{
		return [];
	}
}
