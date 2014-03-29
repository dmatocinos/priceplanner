<?php

class BusinessType extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public static function getBusinessTypes()
	{
		$business_types = DB::table('business_types')->get();	
		$data = [];
		foreach ($business_types as $business_type)
		{
			$data[$business_type->id] = $business_type->name; 
		}

		return $data;
	}

}
