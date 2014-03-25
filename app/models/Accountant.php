<?php

class Accountant extends \Eloquent {

	protected $fillable = [
		'accountant_name',
		'accountancy_name',
		'address',
		'logo_filename'
	];

	public static $rules = array(
		'accountant_name' => 'required',
		'accountancy_name' => 'required',
		'address'	=> 'required',
		'logo_filename'	=> 'image|max:1500'
	);

}
