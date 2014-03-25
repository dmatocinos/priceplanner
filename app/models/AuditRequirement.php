<?php

class AuditRequirement extends \Eloquent {

	protected $fillable = [
		'name',
		'qty',
		'label',
		'value'
	];

	public static $rules = [
		'name'	=> 'required',
		'qty' => 'required|numeric',
		'label' => 'required',
		'value'	=> 'required'
	];

	public static function getAuditRequirements()
	{
		$res = DB::table('audit_requirements')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->label; 
		}

		return $data;
	}

}
