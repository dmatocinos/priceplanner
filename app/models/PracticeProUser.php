<?php

/**
 * A wrapper to the practice pro users table 
 *
 * @author mmacaso
 */
 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PracticeProUser extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * Default password
	 *
	 * @var string
	 */
	const APP_PASSWORD = "r3mun3r@t1on!";
	
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
	protected $table = 'practice_pro_login';

	/**
	 * Table's primary key
	 *
	 * @var string
	 */
	protected $primaryKey = 'mh2_id';

	/**
	 * There are no updated_at and created_At column
	 *
	 * @var boolean
	 */
	public $timestamps = FALSE;
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static function findByEmail($email, $password) {
		// TODO: do we need to use restful?
		// TODO: check also if the user has the permission to use biz val
		return DB::connection('practicepro_users')
			->select(DB::raw("SELECT * FROM practice_pro_login WHERE mh2_email = :email AND mh2_password = :password LIMIT 1"), array(
				'email'    => $email,
				'password' => md5($password)
			));
	}

	/**
	 * User - PracticeProUser relationship definition
	 *
	 */
	public function user()
	{
		return $this->hasOne('User', 'username', 'mh2_id');
	}


	/**
	 * L4 needs to be updated to 4.1.x for this to work. For now, let's use accessor
	 *
	public function pricing()
	{
		return $this->belongsTo('Pricing', 'membership_level', 'mh2_membership_level');
	}
	*/
	public function getAppPricingAttribute()
	{
		return AppPricing::where('membership_level', '=', $this->membership_level)->first();
	}

	/**
	 * Alias to mh2_membership_level attribute
	 *
	 * @return string
	 */
	public function getMembershipLevelAttribute()
	{
		return (empty($this->mh2_membership_level) ? 'Pay as you go' : $this->mh2_membership_level);
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->mh2_password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->mh2_email;
	}
}
