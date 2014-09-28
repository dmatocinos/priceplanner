<?php

class AuditRisk extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getAuditRisks()
	{
		$res = DB::table('audit_risks')->get();	
		$data = [];
		foreach ($res as $row) {
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

	public static function getId($name)
	{
		return DB::table('audit_risks')->where('name', $name)->pluck('id');
	}
}
