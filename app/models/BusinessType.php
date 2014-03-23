<?php

class BusinessType extends \Eloquent {

	protected $fillable = [
		'name',
		'base_fee',
	];

	public static $rules = [
		'name'	=> 'required',
		'base_fee' => 'required|numeric',
	];

}
