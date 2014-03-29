<?php

class AuditRequirement extends \Eloquent {

	protected $fillable = [
		'name',
		'qty',
		'label',
	];

	public static $rules = [
		'name'	=> 'required',
		'qty' => 'required|numeric',
		'label' => 'required',
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
