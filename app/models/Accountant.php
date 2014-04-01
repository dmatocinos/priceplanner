<?php

class Accountant extends \Eloquent {

	protected $fillable = [
		'user_id',
		'accountant_name',
		'accountancy_name',
		'address',
		'logo_filename',
		'last_tab'
	];

	public static $rules = array(
		'accountant_name' => 'required',
		'accountancy_name' => 'required',
		'address'	=> 'required',
		'logo_filename'	=> 'image|max:1500'
	);
	
	public function accountantBusinessTypes ()
	{
		return $this->hasMany('AccountantBusinessType');
	}
	
	public function accountantTurnoverRanges ()
	{
		return $this->hasMany('AccountantTurnoverRange');
	}
}
