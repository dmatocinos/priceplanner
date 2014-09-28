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

Route::get('migrate/{key?}',  array('as' => 'migrate', function($key = null)
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

Route::get('pull/{key?}',  array('as' => 'pull', function($key = null)
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
});

Route::group(array('after' => 'subscribe', 'before' => 'auth'), function() {
	# practice details setup
	Route::get("practicedetails/setup", array('as' => 'practicedetails.setup', 'uses' => 'PracticeDetailsSetupController@index'));
	Route::put("practicedetails/setup/store", array('as' => 'practicedetails.setup.store', 'uses' => 'PracticeDetailsSetupController@store'));
	Route::put("practicedetails/setup/update", array('as' => 'practicedetails.setup.update', 'uses' => 'PracticeDetailsSetupController@update'));

	# practice details business types
	Route::get("practicedetails/businesstypes", array('as' => 'practicedetails.businesstypes', 'uses' => 'PracticeDetailsBusinessTypeController@index'));
	Route::put("practicedetails/businesstypes/store", array('as' => 'practicedetails.businesstypes.store', 'uses' => 'PracticeDetailsBusinessTypeController@store'));
	Route::put("practicedetails/businesstypes/update", array('as' => 'practicedetails.businesstypes.update', 'uses' => 'PracticeDetailsBusinessTypeController@update'));
	Route::get("practicedetails/businesstypes/reset/{accountant_id}", array('as' => 'practicedetails.businesstypes.reset', 'uses' => 'PracticeDetailsBusinessTypeController@reset'));
	
	# practice details turnover ranges
	Route::get("practicedetails/ranges", array('as' => 'practicedetails.ranges', 'uses' => 'PracticeDetailsRangesController@index'));
	Route::put("practicedetails/ranges/store", array('as' => 'practicedetails.ranges.store', 'uses' => 'PracticeDetailsRangesController@store'));
	Route::put("practicedetails/ranges/update", array('as' => 'practicedetails.ranges.update', 'uses' => 'PracticeDetailsRangesController@update'));
	Route::get("practicedetails/ranges/reset/{accountant_id}", array('as' => 'practicedetails.ranges.reset', 'uses' => 'PracticeDetailsRangesController@reset'));
	
	# practice details record qualities
	Route::get("practicedetails/qualities", array('as' => 'practicedetails.qualities', 'uses' => 'PracticeDetailsQualitiesController@index'));
	Route::put("practicedetails/qualities/store", array('as' => 'practicedetails.qualities.store', 'uses' => 'PracticeDetailsQualitiesController@store'));
	Route::put("practicedetails/qualities/update", array('as' => 'practicedetails.qualities.update', 'uses' => 'PracticeDetailsQualitiesController@update'));
	Route::get("practicedetails/qualities/reset/{accountant_id}", array('as' => 'practicedetails.qualities.reset', 'uses' => 'PracticeDetailsQualitiesController@reset'));
	
	# practice details audit risks
	Route::get("practicedetails/audit", array('as' => 'practicedetails.audit', 'uses' => 'PracticeDetailsAuditController@index'));
	Route::put("practicedetails/audit/store", array('as' => 'practicedetails.audit.store', 'uses' => 'PracticeDetailsAuditController@store'));
	Route::put("practicedetails/audit/update", array('as' => 'practicedetails.audit.update', 'uses' => 'PracticeDetailsAuditController@update'));
	Route::get("practicedetails/audit/reset/{accountant_id}", array('as' => 'practicedetails.audit.reset', 'uses' => 'PracticeDetailsAuditController@reset'));
	
	# practice details taxes
	Route::get("practicedetails/taxes", array('as' => 'practicedetails.taxes', 'uses' => 'PracticeDetailsTaxesController@index'));
	Route::put("practicedetails/taxes/store", array('as' => 'practicedetails.taxes.store', 'uses' => 'PracticeDetailsTaxesController@store'));
	Route::put("practicedetails/taxes/update", array('as' => 'practicedetails.taxes.update', 'uses' => 'PracticeDetailsTaxesController@update'));
	Route::get("practicedetails/taxes/reset/{accountant_id}", array('as' => 'practicedetails.taxes.reset', 'uses' => 'PracticeDetailsTaxesController@reset'));
	
	# practice details bookeeping
	Route::get("practicedetails/bookkeeping", array('as' => 'practicedetails.bookkeeping', 'uses' => 'PracticeDetailsBookkeepingController@index'));
	Route::put("practicedetails/bookkeeping/store", array('as' => 'practicedetails.bookkeeping.store', 'uses' => 'PracticeDetailsBookkeepingController@store'));
	Route::put("practicedetails/bookkeeping/update", array('as' => 'practicedetails.bookkeeping.update', 'uses' => 'PracticeDetailsBookkeepingController@update'));
	Route::get("practicedetails/bookkeeping/reset/{accountant_id}", array('as' => 'practicedetails.bookkeeping.reset', 'uses' => 'PracticeDetailsBookkeepingController@reset'));

	# practice details payrolls
	Route::get("practicedetails/payrolls", array('as' => 'practicedetails.payrolls', 'uses' => 'PracticeDetailsPayrollsController@index'));
	Route::put("practicedetails/payrolls/store", array('as' => 'practicedetails.payrolls.store', 'uses' => 'PracticeDetailsPayrollsController@store'));
	Route::put("practicedetails/payrolls/update", array('as' => 'practicedetails.payrolls.update', 'uses' => 'PracticeDetailsPayrollsController@update'));
	Route::get("practicedetails/payrolls/reset/{accountant_id}", array('as' => 'practicedetails.payrolls.reset', 'uses' => 'PracticeDetailsPayrollsController@reset'));
	
	# practice details services
	Route::get("practicedetails/services", array('as' => 'practicedetails.services', 'uses' => 'PracticeDetailsServicesController@index'));
	Route::put("practicedetails/services/store", array('as' => 'practicedetails.services.store', 'uses' => 'PracticeDetailsServicesController@store'));
	Route::put("practicedetails/services/update", array('as' => 'practicedetails.services.update', 'uses' => 'PracticeDetailsServicesController@update'));
	Route::get("practicedetails/services/reset/{accountant_id}", array('as' => 'practicedetails.services.reset', 'uses' => 'PracticeDetailsServicesController@reset'));
	
	Route::group(array('before' => 'practicedetailscompleted'), function() {
		Route::get("home", "HomeController@index");

		# setup  
		Route::get("setup", array('as' => 'setup.create', 'uses' => "SetupController@create"));
		Route::get("setup/edit/{id}", array('as' => 'setup.edit', 'uses' => 'SetupController@editClient'));
		Route::put("setup/create", array('as' => 'setup.store', 'uses' => 'SetupController@store'));
		Route::put("setup/edit", array('as' => 'setup.update', 'uses' => 'SetupController@update'));

		Route::get('client_details/new', 'SetupController@newClient');
		Route::get('client_details/existing/{client_id}', 'SetupController@existingClient');
		Route::post('client_details/add', array('as' => 'add_client', 'uses' => 'SetupController@addClient'));
		Route::put('client_details/create', array('as' => 'create_client', 'uses' => 'SetupController@createClient'));
		Route::put('client_details/update', array('as' => 'update_client', 'uses' => 'SetupController@updateClient'));

		# fee planner 
		Route::get("feeplanner/{client_id}", array('as' => 'feeplanner.create', 'uses' => 'FeePlannerController@create'));
		Route::get("feeplanner/edit/{pricing_id}", array('as' => 'feeplanner.edit', 'uses' => 'FeePlannerController@edit'));
		Route::put("feeplanner/create", array('as' => 'feeplanner.store', 'uses' => 'FeePlannerController@store'));
		Route::put("feeplanner/edit", array('as' => 'feeplanner.update', 'uses' => 'FeePlannerController@update'));

		# plan summary 
		Route::get("plansummary/{pricing_id}", array('as' => 'plansummary', 'uses' => 'PlanSummaryController@index'));

		Route::group(array('before' => 'free_trial'), function() {
			# report 
			Route::get("report/fixedprice/{pricing_id}", array('as' => 'fixedprice', 'uses' => 'ReportController@fixedPrice'));
			Route::get("report/appendix/{pricing_id}", array('as' => 'appendix', 'uses' => 'ReportController@appendix'));
			Route::get("report/fixedprice/{pricing_id}", array('as' => 'fixedprice', 'uses' => 'ReportController@fixedPrice'));
			Route::get("report/plansummary/{pricing_id}", array('as' => 'plansummary', 'uses' => 'ReportController@planSummary'));
		});

		Route::get("restrictdownloads/{pricing_id}", array('as' => 'restrictdownloads', 'uses' => 'PlanSummaryController@restrictDownloads'));
	});

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

	Route::post('email_support', array('as' => 'email_support', 'uses' => 'BaseController@sendEmailSupport'));

});

