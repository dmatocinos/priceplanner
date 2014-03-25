<?php

class TurnoverRange extends \Eloquent {

	protected $fillable = [
		'name',
	];

	public static $rules = [
		'name'	=> 'required',
	];

}
