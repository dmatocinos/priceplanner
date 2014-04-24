<?php

class OtherService extends \Eloquent {

	protected $fillable = [
		'name',
		'user_defined',
	];

	public static $rules = [
		'name'	=> 'required',
	];

	public $timestamps = false;

	public static function getOtherServices($accountant_id = null, $user_defined = null)
	{
		$table = DB::table('other_services');
		
		if (! is_null($accountant_id)) {
			$table
				->join('accountant_other_services', 'accountant_other_services.other_service_id', '=', 'other_services.id')
				->where('accountant_id', $accountant_id);
		}

		if ( ! is_null($user_defined) && $user_defined) {
			$table
				->where('user_defined', true);
		}		
		else if ( ! is_null($user_defined) && $user_defined == false) {
			$table
				->where('user_defined', false);
		}
		else  {
			$table
				->orWhereNull('user_defined');
		}
		$table->orderBy('user_defined');

		$res = $table->get();	
		$data = [];
		foreach ($res as $row)
		{
			$data[$row->other_service_id] = $row->name; 
		}

		return $data;
	}

	public function accountantOtherService()
	{
		return $this->hasOne('AccountantOtherService');
	}

	

}
