<?php


class PracticeProClient extends Eloquent {

	protected $fillable = [
		'user_id',
		'business_name',
		'contact_name',
		'period_start_date',
		'period_end_date',
		'address_1',
		'address_2',
		'city',
		'county',
		'country',
		'postcode',
		'phone_number',
		'mobile_number',
		'email',
		'website',
		'logo_filename',
		'year_end',
		'business_status',
		'business_type',
		'industry_sector',
		'currency',
	];

	public static $rules = [
		'business_name'		=> 'required|Max:80',
		'contact_name'		=> 'required|Max:80',
		'address_1'  		=> 'required|Max:80',
		'country' 		=> 'required|Max:80',
		'phone_number'		=> 'required|numeric',
		'logo_filename'		=> 'image',
		'email'			=> 'required|email',
	];

	protected $connection = 'practicepro_users';
	protected $table = 'clients';

	public static function getAllCurrentClients()
	{
		return DB::connection('practicepro_users')->table('clients')->where('user_id', Sentry::getUser()->practiceProUser()->mh2_id)->lists('contact_name', 'id');	
	}



}
