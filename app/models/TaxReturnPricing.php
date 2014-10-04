<?php

class TaxReturnPricing extends \Eloquent {

	protected $fillable = [
		'qty',
		'tax_return_id',
		'pricing_id',
	];

	public static $rules = [
		'qty'	=> 'required|numeric',
	];

	public $timestamps = false;

	public function otherService()
	{
		return $this->belongsTo('TaxReturn');
	}

	public static function getTaxReturnPricings($accountant_id, $pricing_id = NULL)
	{
		$pricing = Pricing::find($pricing_id);
		$data = [];
		if ($pricing) {
			$trpricings = DB::select("
				SELECT tr.id as tax_return_id, trp.*
				FROM tax_returns tr
				LEFT JOIN tax_return_pricings trp ON tr.id = trp.tax_return_id
				WHERE trp.pricing_id = :pricing_id
			", array('pricing_id' => $pricing_id));

			foreach ($trpricings as $row) {
				$data[$row->tax_return_id] = $row->qty;
			}
		}
		else {
			$tax_returns = TaxReturn::getOtherTaxReturns($accountant_id);
			foreach ($tax_returns as $id => $val) {
				$data[$id] = NULL;
			}

		}

		return $data;
	}

}
