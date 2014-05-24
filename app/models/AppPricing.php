<?php

use \Carbon\Carbon;

class AppPricing extends Eloquent {
	protected $guarded = array();
	
	/**
	 * The database connection name where the
	 * table's database is located
	 *
	 * @var string
	 */
	protected $connection = 'practicepro_users';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'application_discounts';

	/**
	 * Table's primary key
	 *
	 * @var string
	 */
	protected $primaryKey = 'application_discount_id';
	
	public static $rules = array();


	/**
	 * L4.1.x version only
	 *
	 */
	public function practiceProUsers()
	{
		return $this->hasMany('PracticeProUser', 'mh2_membership_level', 'membership_level');
	}

	public function getPracticeProUsersAttribute()
	{
		return PracticeProUser::where('mh2_membership_level', '=', $this->membership_level)->get();
	}

	/**
	 * Get the amount to be paid by user after deducting the discount.
	 *
	 * @return numeric
	 */
	public function getDiscountedAmount($period)
	{
		$amount = $this->getAmount($period);

		return $amount - ($amount * $this->discount);
	}

	/**
	 * Product is free if discounted is 100%
	 *
	 * @return bool
	 */
	public function getIsFreeAttribute()
	{
		return $this->discount == 1 || $this->discount == 0;
	}

	/**
	 * Get the undiscounted amount for this product.
	 *
	 * @return numeric
	 */
	public function getAmount($period)
	{
		$amount = Config::get('paypal.amount');

		return $amount[$period];
	}

	public static function getPaymentOptions()
	{
		return Config::get('paypal.amount');
	}

}
