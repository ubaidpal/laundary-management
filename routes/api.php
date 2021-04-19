<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user',function(){
    return Auth::user();
})->middleware('auth:api');

Route::get('/password',function(){
    return Hash::make('123456789');
});
Route::get('payment','API\AuthenticationController@paymenttest');
Route::post('login', 'API\AuthenticationController@login')->name('api.login');
Route::post('register', 'API\AuthenticationController@register');
Route::post('checkemail', 'API\AuthenticationController@checkemail');
Route::post('forgetPassword','API\AuthenticationController@forgetPassword');
Route::get('/reset-password/{token}','API\AuthenticationController@resetPassword')->name('apipassword.reset')->middleware('web');
Route::post('password/{token}','API\AuthenticationController@updatePassword')->name('reset.password')->middleware('web');
Route::get('/password/changed','API\AuthenticationController@passwordChanged')->name('password.changed')->middleware('web');

Route::get('/aboutus','API\BasicController@aboutus');
Route::get('/policy','API\BasicController@policy');
Route::get('/terms','API\BasicController@terms');
Route::get('/faq','API\BasicController@faq');

        Route::get('/schoolsList','API\UserController@getSchoolsList');
        Route::get('/buildingList/{school_id}','API\UserController@getbuildingList');

Route::group([
    'namespace' => 'API',
    'middleware' => ['assign.guard:api','auth:api'],
    ],function(){

        Route::get('/logout','AuthenticationController@logout');
        
        Route::get('/getProfile','UserController@getProfile');
        Route::post('/updateProfile','UserController@updateProfile');
        Route::get('/getLaundryPacks','UserController@getLaundryPacks');
        Route::get('/getHousekeepingPlans','UserController@getHousekeepingPlans');
        Route::get('/getStoragePlans','UserController@getStoragePlans');
        Route::get('/getNotifications','UserController@getNotifications');
        Route::post('/changepassword','UserController@changepassword');
        Route::post('/contactus','UserController@contactus');
        Route::post('/preference','UserController@preference');

        Route::get('/getLaundryItems','UserController@getLaundryItems');
        Route::get('/getdrycleanItems','UserController@getdrycleanItems');
        Route::get('/getHousekeepingItems','UserController@getHousekeepingItems');
        Route::get('/getStorageItems','UserController@getStorageItems');

        Route::post('/addToCart','UserController@addToCart');
        Route::get('/getCart','UserController@getCart');
        Route::get('/removeCart/{id}','UserController@removeCart');
        Route::get('/checkCart','UserController@checkCart');

        Route::post('/addCard','UserController@addCard');
        Route::get('/getCards','UserController@getCards');
        Route::get('/makeDefaultCard/{id}','UserController@makeDefaultCard');
        Route::get('/deleteCard/{id}','UserController@deleteCard');

        Route::get('/prefference','UserController@getPrefference');
        Route::post('/prefference','UserController@setPrefference');

        Route::post('/applyPromocode','UserController@applyPromocode');
        Route::post('editPlan','UserController@editPlan');

        Route::post('/booking','UserController@booking');

        Route::post('/addToCartLaundry','UserController@addToCartLaundry');
        Route::get('/getLaundryCart','UserController@getLaundryCart');

        Route::get('/getInsurance','UserController@getInsurance');
        Route::get('/getInsurance_new','UserController@getInsurance_new');
        Route::get('/myservice','UserController@myservice');

        Route::get('/pastOrder','UserController@pastOrder');
        Route::get('/currentOrder','UserController@currentOrder');
        Route::get('/order','UserController@order');
        Route::get('/orderDetails/{id}','UserController@orderDetails');

        Route::post('/bookLaundry','UserController@bookLaundry');
        Route::get('/help','BasicController@help');

        Route::post('/claim','UserController@claim');
        Route::get('/getClaim/{id}','UserController@getClaim');
        Route::get('/getAllClaim','UserController@getAllClaim');

        Route::post('/rescheduleStorage','UserController@rescheduleStorage');
        Route::post('/rescheduleHousekeeping','UserController@rescheduleHousekeeping');
        Route::post('/housekeepingSpecialRequest','UserController@housekeepingSpecialRequest');

        Route::get('/notifications','UserController@notifications');
        Route::post('/notification-type','UserController@changeNotificationType');
        Route::get('/get-notification-type','UserController@getNotificationType');
        Route::post('/cancleSubscription/{id}','UserController@cancleSubscription');
        Route::get('/getBillingAddress','UserController@getBillingAddress');
        Route::get('/subscriptions','UserController@subscriptions');


        //////////////// for web api /////////////////

        Route::post('/updateServiceAddress','UserController@updateServiceAddress');
        Route::post('/billingAddress','UserController@billingAddress');
        Route::post('/addupdateCard','UserController@addupdateCard');
        // Aman kumar
        Route::get('/how-it-works','HowitworkController@index');
        Route::get('/couponList','UserController@couponLists');
        Route::get('/get-refer-friend','UserController@getReferFriends');
        Route::get('/prefference-text','UserController@getPrefferenceText');


        
});

Route::post('/billingAddress_web','API\\UserController@billingAddress_web');
Route::post('/addupdateCard_web','API\\UserController@addupdateCard_web');
Route::get('/getLaundryPacks_web','API\\UserController@getLaundryPacks');

Route::get('thanksPage','API\\UserController@thanks');
Route::get('intro-thanks-pages','API\\UserController@introThanksPages'); 
