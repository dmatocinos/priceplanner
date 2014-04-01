<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class SubscriptionController extends BaseController {
	protected $layout = 'layout.subscribe';
	protected $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = Sentry::getUser();
	}

	// @todo move to service
	protected function getGateway()
	{
		$gateway = new GatewayFactory();
		$gateway = $gateway->create(Config::get('paypal.gateway'));

		$gateway->setUsername(Config::get('paypal.username'));
		$gateway->setPassword(Config::get('paypal.password')); 
		$gateway->setSignature(Config::get('paypal.signature'));
		$gateway->setTestMode(Config::get('paypal.test_mode'));

		return $gateway;
	}

	// @todo move to service
	protected function getPurchaseData($period)
	{
		$pricing    = $this->user->practiceProUser()->app_pricing;

		$now = Carbon::now();
		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount($period),
			'description'	=> Config::get('paypal.description') . " Payment on {$now->toFormattedDateString()}",
			'returnUrl'	=> route('complete_payment', array($period)),
			'cancelUrl'	=> route('subscribe'),
			'currency'	=> Config::get('paypal.currency')
		);

		return $paypal_data;
	}

	/**
	 * Show the PayPal payment screen
	 *
	 */
	public function subscribe()
	{
		$pricing    = $this->user->practiceProUser()->app_pricing;
		
		if ($pricing->is_free) {
			return Redirect::route('complete_subscription');
		}

		$level    = $this->user->practiceProUser()->membership_level;
		$discount = $pricing->discount * 100;
		$periods  = AppPricing::getPaymentOptions() ;
		
		foreach ($periods as $period => $amount) {
			if ($period == 'monthly') {
				$term = 'month';
			}
			else {
				$term = 'year';
			}
			$discounted[$period] = NumFormatter::money($pricing->getDiscountedAmount($period), '&pound;') . " for 1 {$term}";
		}

		switch ($this->user->practiceProUser()->membership_level) {
			case 'Tax Club':
				$msg = "As a Tax Club Member of PracticePro";
				break;
				
			case 'Elite Member':
				$msg = "As an Elite Member of PracticePro";
				break;
			
			case 'Pay as you go':
			default:
				$msg = "As a Pay as you go member of PracticePro";
				break;
		}
		
		if ($discount > 0) {
			$msg .= ", we are giving you a special " . $discount . "% discount. Don't let this offer pass!";
		}
		else {
			$msg = "You can continue using PricePlannerPro for only:";
		}
		
		$data = array(
			'msg'	=> $msg,
			'discounted' => $discounted
		);

		$this->layout->content = View::make("subscription.subscribe", $data);
	}
	
	public function startPayment($period) 
	{
		$gateway = $this->getGateway();

		try {
			$response = $gateway->purchase($this->getPurchaseData($period))->send();
			if ($response->isRedirect()) {
				// it should redirect to PayPal payment page
				$response->redirect();
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function cancelPayment()
	{
		return Redirect::to("subscribe");
	}

	public function completePayment($period)
	{
		$user = $this->user;

		$gateway = $this->getGateway();

		try {
			$response = $gateway->completePurchase($this->getPurchaseData($period))->send();
			if ($response->isSuccessful()) {
				
				$transaction_data = $response->getData();
				
				$payment_data = array(
					'user_id'        => $this->user->id,
					'amount'         => $transaction_data['PAYMENTINFO_0_AMT'],
					'transaction_id' => $transaction_data['PAYMENTINFO_0_TRANSACTIONID'],
					'order_time'     => $transaction_data['PAYMENTINFO_0_ORDERTIME']
				);
				$payment = Payment::create($payment_data);
				$payment->save();

				$now = Carbon::now();
				switch($period) {
					case 'monthly':
						$user->valid_until = $now->addMonth();
						break;
					case 'yearly':
						$user->valid_until = $this->addYear();
						break;
				}
				$user->save();

				return Redirect::to('home');
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function completeSubscription()
	{
		return Redirect::to('home');
	}

}
