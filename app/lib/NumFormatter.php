<?php

/**
 * Money Formatter
 *
 * @package helpers
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/

class NumFormatter {
	
	public function __construct()
	{

	}	

	public function test()
	{
		return 1;
	}	

	/*
	 * returns money as a formatted string
	 * @param integer $amount
	 * @param string $symbol currency symbol
	 * @return string
	 */
	public static function money($amount, $symbol = '$')
	{
		if (is_null($amount)) {
			return NULL;
		}

		if (!is_numeric($amount)) {
			$amount = 0;
		}
		
		if($amount >= 0) {
			return $symbol . self::number($amount, 0);
		}
		else {
			$amount = $amount * -1;
			return '(' . $symbol . self::number($amount, 0) . ')';
		}
	}
	
	/*
	 * returns percent as a formatted string
	 * @param float $percent
	 * @return string
	 */
	public static function percent($percent)
	{
		if (is_null($percent)) {
			return NULL;
		}

		if (!is_numeric($percent)) {
			$percent = 0;
		}
		
		if($percent >= 0) {
			return self::number($percent) . "%";
		}
		else {
			$percent = $percent * -1;
			return '(' . self::number($percent) . "%)";
		}
	}
	
	/*
	 * returns checkboxvalue as a formatted string
	 * @param float $percent
	 * @return string
	 */
	public static function checkbox($val)
	{
		if ($val === TRUE || $val === 1) {
		//	return 'Yes';
			return '<span style="font-family: zapfdingbats; font-size: 8px;" class="val">3 </span>';
		}
		else {
		//	return 'No';
			return '';
		}
	}
	
	public static function number($num, $places = 2) 
	{
		//if (self::is_windows()) {
			return number_format(round($num, $places), $places);
		//}
		//else {
		//	return money_format('%i', $num);
		//}
	}
	
	public static function is_windows() 
	{
		if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
