<?php
/*
|--------------------------------------------------------------------------
| Scaffolding/Testing
|--------------------------------------------------------------------------
|
| @todo: comment out on production
|
*/
Route::get('install/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
					
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--package'     => "cartalyst/sentry"
                               ]);
                       echo 'done sentry tables';
                       
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';
					
                       echo '<br>init with tables seeders...';
                       Artisan::call('db:seed');
                       echo '<br>done with tables seeders...';

               } catch (Exception $e) {
					echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

Route::get('migrate/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';

               } catch (Exception $e) {
					echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

Route::get('pull/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
                       echo '<br>git pull origin master...';
		       SSH::run(array(
			       'cd /kunden/homepages/46/d354086249/htdocs/priceplannerpro-app',
			       'git pull origin master',
		       ));
                       echo '<br>done pulling changes.';

               } catch (Exception $e) {
		    echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'AuthController@getSignin');

Route::group(array('before' => 'auth'), function() {
	# payment
	Route::get('subscribe', array('as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe'));
	Route::get('start_payment/{period}', array('as' => 'start_payment', 'uses' => 'SubscriptionController@startPayment'));
	Route::get('cancel_payment', array('as' => 'cancel_payment', 'uses' => 'SubscriptionController@cancelPayment'));
	Route::get('complete_payment/{period}', array('as' => 'complete_payment', 'uses' => 'SubscriptionController@completePayment'));
	Route::get('complete_subscription', array('as' => 'complete_subscription', 'uses' => 'SubscriptionController@completeSubscription'));

	Route::get("home", "HomeController@index");

	# setup  
	Route::get("setup", array('as' => 'setup.create', 'uses' => "SetupController@create"));
	Route::get("setup/edit/{client_id}", array('as' => 'setup.edit', 'uses' => 'SetupController@edit'));
	Route::put("setup/create", array('as' => 'setup.store', 'uses' => 'SetupController@store'));
	Route::put("setup/edit", array('as' => 'setup.update', 'uses' => 'SetupController@update'));

	# fee levels
	Route::get("feelevels/{client_id}", array('as' => 'feelevels.create', 'uses' => 'FeeLevelController@create'));
	Route::get("feelevels/edit/{client_id}", array('as' => 'feelevels.edit', 'uses' => 'FeeLevelController@edit'));
	Route::put("feelevels/create", array('as' => 'feelevels.store', 'uses' => 'FeeLevelController@store'));
	Route::put("feelevels/edit", array('as' => 'feelevels.update', 'uses' => 'FeeLevelController@update'));

	# fee planner 
	Route::get("feeplanner/{client_id}", array('as' => 'feeplanner.create', 'uses' => 'FeePlannerController@create'));
	Route::get("feeplanner/edit/{pricing_id}", array('as' => 'feeplanner.edit', 'uses' => 'FeePlannerController@edit'));
	Route::put("feeplanner/create", array('as' => 'feeplanner.store', 'uses' => 'FeePlannerController@store'));
	Route::put("feeplanner/edit", array('as' => 'feeplanner.update', 'uses' => 'FeePlannerController@update'));

	# plan summary 
	Route::get("plansummary/{pricing_id}", array('as' => 'plansummary', 'uses' => 'PlanSummaryController@index'));

	# report 
	Route::get("report/fixedprice/{pricing_id}", array('as' => 'fixedprice', 'uses' => 'ReportController@fixedPrice'));
	Route::get("report/appendix/{pricing_id}", array('as' => 'appendix', 'uses' => 'ReportController@appendix'));

	# price details setup
	Route::get("pricedetails/setup", array('as' => 'pricedetails.setup.create', 'uses' => 'PriceDetailsSetupController@create'));
	Route::get("pricedetails/setup/edit/{accountant_id}", array('as' => 'pricedetails.setup.edit', 'uses' => 'PriceDetailsSetupController@edit'));
	Route::put("pricedetails/setup/create", array('as' => 'pricedetails.setup.store', 'uses' => 'PriceDetailsSetupController@store'));
	Route::put("pricedetails/setup/edit", array('as' => 'pricedetails.setup.update', 'uses' => 'PriceDetailsSetupController@update'));

	# price details business types
	Route::get("pricedetails/businesstypes/create/{accountant_id}", array('as' => 'pricedetails.BusinessType.create', 'uses' => 'PriceDetailsBusinessTypeController@create'));
	Route::get("pricedetails/businesstypes/edit/{accountant_id}", array('as' => 'pricedetails.businesstypes.edit', 'uses' => 'PriceDetailsBusinessTypeController@edit'));
	Route::put("pricedetails/businesstypes/create", array('as' => 'pricedetails.businesstypes.store', 'uses' => 'PriceDetailsBusinessTypeController@store'));
	Route::put("pricedetails/businesstypes/edit", array('as' => 'pricedetails.businesstypes.update', 'uses' => 'PriceDetailsBusinessTypeController@update'));
});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
*/
Route::group(array(), function() {
	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
	
	# Check Auth
	Route::get('check', array('as' => 'check', 'uses' => 'AuthController@checkAuth'));

	Route::get('paid{user_id}', array('as' => 'paid', 'uses' => 'AuthController@paid'));
	Route::get('cancel_payment/{user_id}', array('as' => 'cancel_payment', 'uses' => 'AuthController@cancelPayment'));
});

