<?php

class AuditRisk extends \Eloquent {

	protected $fillable = [
		'name',
		'qty',
		'percentage',
	];

	public static $rules = [
		'name'	=> 'required',
		'qty' => 'required|numeric',
		'percentage' => 'required',
	];

	public static function getAuditRisks()
	{
		$res = DB::table('audit_risks')->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

}
