<?php

class ClientTaxReturn extends \Eloquent {
	protected $fillable = [
		'value',
		'client_id',
		'tax_return_id'
	];

	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function taxReturn()
	{
		return $this->belongsTo('TaxReturn');
	}

}
