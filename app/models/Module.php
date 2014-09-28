<?php

class Module extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public $timestamps = false;

	public static function getModules($accountant_id = null)
	{
		$table = DB::table('modules');

		if ($accountant_id) {
			$table
				->join('accountant_modules', 'accountant_modules.module_id', '=', 'moduless.id')
				->where('accountant_id', $accountant_id);
		}		

		$res = $table->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->id] = $row->name; 
		}

		return $data;
	}

	public static function getId($name)
	{
		return DB::table('modules')->where('name', $name)->pluck('id');
	}


}
