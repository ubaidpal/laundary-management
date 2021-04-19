<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/demoCardToken','HomeController@demoCardToken')->name('demoCardToken');
Route::get('/route-cache', function() {
   //shell_exec('composer dump-autoload');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
  return 'Routes cache cleared';
});

Route::get('/email-cleanclothes-tshirt','Admin\EmailSentController@emailSentForCleanClothesTshirts');
Route::get('/email-cleanclothes-basket','Admin\EmailSentController@emailSentForCleanClothesBasket');
Route::get('/email-its-laundry-day','Admin\EmailSentController@emailItsLaundryDay');

Route::get('/getUsers','Admin\EmergencyMessageController@getUsers');
Route::get('/getSchools','Admin\EmergencyMessageController@getSchools');
Route::get('/order-notfications','Admin\OrderController@cronJobNotifications');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/404',function(){
    return view('404');
})->name('404');

// Route::group([
//     'middleware' => 'checkpage',
// ],function(){
//     Route::get('/{url}','HomeController@cmspages');
// });

Route::group([
            'prefix' => 'admin',
        ],function(){
            // Authentication Routes...
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
            Route::post('login', 'Auth\LoginController@login');

            // Password Reset Routes...
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');

            Route::group([
                    'middleware' => ['auth','checkadmin'],
                    'namespace' => 'Admin'
            ],function(){
            //Admin Routes
                Route::get('/home', 'AdminController@index')->name('home');
                Route::get('/profile', 'AdminController@showProfile')->name('profile.show');
                Route::post('/profile', 'AdminController@updateProfile')->name('profile.update');
                Route::get('/password', 'AdminController@showPassword')->name('password.show');
                Route::post('/password', 'AdminController@updatePassword')->name('password.update');

                Route::get('/logout', 'AdminController@logout')->name('logout');

                Route::fallback(function() {
                    return redirect()->route('home');
                });

                Route::group([
                    'prefix' => 'users'
                ],function(){
                    Route::get('/','UserController@index')->name('users.index');
                    Route::get('/add', 'UserController@single')->name('users.single');
                    Route::post('/add', 'UserController@create')->name('users.create');
                    Route::get('/edit/{id}', 'UserController@showEditForm')->name('users.edit')->where('id','[0-9]+');
                    Route::post('/edit/{id}', 'UserController@update')->name('users.update')->where('id','[0-9]+');
                    Route::get('/view/{id}', 'UserController@view')->name('users.view')->where('id','[0-9]+');
                    Route::post('delete', 'UserController@delete')->name('users.delete')/*->where('id','[0-9]+')*/;
                    //Route::get('/status/{id?}/{status?}','UserController@status')->name('users.status')->where('id','[0-9]+')->where('status','[0-9]+');
                    Route::post('status','UserController@status')->name('users.status');
                    Route::get('/export','UserController@exportExcel')->name('users.export');

                });

                Route::group([
                    'prefix' => 'staff'
                ],function(){
                    Route::get('/','StaffMembersController@index')->name('staff_members.index');
                    Route::get('/add','StaffMembersController@single')->name('staff_members.single');
                    Route::post('/add','StaffMembersController@create')->name('staff_members.create');
                    Route::get('/edit/{id}', 'StaffMembersController@showEditForm')->name('staff_members.edit')->where('id','[0-9]+');
                    Route::post('/edit/{id}', 'StaffMembersController@update')->name('staff_members.update')->where('id','[0-9]+');
                    Route::get('/view/{id}', 'StaffMembersController@view')->name('staff_members.view')->where('id','[0-9]+');
                    Route::post('/delete', 'StaffMembersController@delete')->name('staff_members.delete');
                    //Route::get('/delete/{id}', 'StaffMembersController@delete')->name('staff_members.delete')->where('id','[0-9]+');
                    Route::get('/status/{id?}/{status?}','StaffMembersController@status')->name('staff_members.status')->where('id','[0-9]+')->where('status','[0-9]+');
                    Route::post('/status','StaffMembersController@status')->name('staff_members.status');
                });


                Route::group([
                    'prefix' => 'laundry/plans'
                ],function(){
                    Route::get('/','LaundryPlanController@index')->name('laundryplans.index');
                    Route::get('/add','LaundryPlanController@single')->name('laundryplans.single');
                    Route::post('/add','LaundryPlanController@create')->name('laundryplans.create');
                    Route::get('/edit/{id}','LaundryPlanController@showupdate')->name('laundryplans.showupdate')->where('id','[0-9]+');
                    Route::post('/edit/{id}','LaundryPlanController@update')->name('laundryplans.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','LaundryPlanController@delete')->name('laundryplans.delete')->where('id','[0-9]+');
                    Route::post('/delete','LaundryPlanController@delete')->name('laundryplans.delete');
                    Route::post('/status','LaundryPlanController@status')->name('laundryplans.status');
                    //Route::get('/status/{id}/{status}','LaundryPlanController@status')->name('laundryplans.status')->where('id','[0-9]+')->where('status','[0-1]+');

                    Route::fallback(function() {
                        return redirect()->route('plans.index');
                    });
                });

                Route::group([
                    'prefix' => 'housekeeping/plans'
                ],function(){
                    Route::get('/','HousekeepingPlanController@index')->name('housekeepingplans.index');
                    Route::get('/add','HousekeepingPlanController@single')->name('housekeepingplans.single');
                    Route::post('/add','HousekeepingPlanController@create')->name('housekeepingplans.create');
                    Route::get('/edit/{id}','HousekeepingPlanController@showupdate')->name('housekeepingplans.showupdate')->where('id','[0-9]+');
                    Route::post('/edit/{id}','HousekeepingPlanController@update')->name('housekeepingplans.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','HousekeepingPlanController@delete')->name('housekeepingplans.delete')->where('id','[0-9]+');
                    Route::post('/delete','HousekeepingPlanController@delete')->name('housekeepingplans.delete');
                    //Route::get('/status/{id}/{status}','HousekeepingPlanController@status')->name('housekeepingplans.status')->where('id','[0-9]+')->where('status','[0-1]+');
                    Route::post('/status','HousekeepingPlanController@status')->name('housekeepingplans.status');

                    Route::fallback(function() {
                        return redirect()->route('housekeepingplans.index');
                    });
                });

                Route::group([
                    'prefix' => 'storage/plans'
                ],function(){
                    Route::get('/','StoragePlanController@index')->name('storageplans.index');
                    Route::get('/add','StoragePlanController@single')->name('storageplans.single');
                    Route::post('/add','StoragePlanController@create')->name('storageplans.create');
                    Route::get('/edit/{id}','StoragePlanController@showupdate')->name('storageplans.showupdate')->where('id','[0-9]+');
                    Route::post('/edit/{id}','StoragePlanController@update')->name('storageplans.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','StoragePlanController@delete')->name('storageplans.delete')->where('id','[0-9]+');
                    Route::post('/delete/','StoragePlanController@delete')->name('storageplans.delete');
                    //Route::get('/status/{id}/{status}','StoragePlanController@status')->name('storageplans.status')->where('id','[0-9]+')->where('status','[0-1]+');
                    Route::post('/status','StoragePlanController@status')->name('storageplans.status');

                    Route::fallback(function() {
                        return redirect()->route('housekeepingplans.index');
                    });
                }); 

                Route::group([
                    'prefix' => 'emergency'
                ],function(){
                    Route::get('/','EmergencyMessageController@usersindex')->name('emergencymessage.usersindex'); 
                    Route::get('/add-users','EmergencyMessageController@single')->name('emergencymessage.usersadd'); 
                    Route::post('/add-users','EmergencyMessageController@create')->name('emergencymessage.create'); 
                    Route::post('/delete-users','EmergencyMessageController@usersdelete')->name('emergencymessage.usersdelete'); 
                    Route::get('/update-users/{id}','EmergencyMessageController@showUserEditForm')->name('emergencymessage.usersupdate'); 
                    Route::post('/update-users','EmergencyMessageController@usersmessageUpdate')->name('emergencymessage.usersmessageupdate'); 

                    Route::get('/messages-school','EmergencyMessageController@schoolindex')->name('emergencymessage.schoolindex'); 
                    Route::get('/add-school','EmergencyMessageController@schoolform')->name('emergencymessage.schoolform'); 
                    Route::post('/add','EmergencyMessageController@schoolcreate')->name('emergencymessage.school_create'); 
                    Route::post('/delete-school','EmergencyMessageController@schooldelete')->name('emergencymessage.schooldeteled'); 
                    Route::post('/update-school','EmergencyMessageController@schoolupdate')->name('emergencymessage.school_update'); 

                    Route::get('/update-school-message/{id}','EmergencyMessageController@showSchoolEditForm')->name('emergencymessage.showSchoolEditform'); 
                    Route::post('/update-users','EmergencyMessageController@usersmessageUpdate')->name('emergencymessage.usersmessageupdate'); 

                    //Route::get('/getUsers','EmergencyMessageController@getUsers');

                    Route::fallback(function() {
                        return redirect()->route('housekeepingplans.index');
                    });
                });

                Route::group([
                    'prefix' => 'addons'
                ], function () {
                    Route::get('/','AddonController@index')->name('addons.index');
                    Route::get('/add','AddonController@single')->name('addons.single');
                    Route::post('/add','AddonController@create')->name('addons.create');
                    Route::get('/edit/{id}','AddonController@showupdate')->name('addons.showupdate')->where('id','[0-9]+');
                    Route::post('/edit/{id}','AddonController@update')->name('addons.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','AddonController@delete')->name('addons.delete')->where('id','[0-9]+');
                    Route::post('/delete','AddonController@delete')->name('addons.delete');
                    //Route::get('/status/{id}/{status}','AddonController@status')->name('addons.status')->where('id','[0-9]+')->where('status','[0-1]+');
                    Route::post('/status','AddonController@status')->name('addons.status');
                   // Route::get('/export','AddonController@exportExcel')->name('addons.export');

                    Route::fallback(function() {
                        return redirect()->route('addons.index');
                    });
                });

                Route::group([
                    'prefix' => 'coupons'
                ], function () {
                    Route::get('/','CouponController@index')->name('coupons.index');
                    Route::get('/add','CouponController@single')->name('coupons.single');
                    Route::post('/add','CouponController@create')->name('coupons.create');
                    Route::get('/edit/{id}','CouponController@showupdate')->name('coupons.showupdate')->where('id','[0-9]+');
                    Route::post('/edit/{id}','CouponController@update')->name('coupons.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','CouponController@delete')->name('coupons.delete')->where('id','[0-9]+');
                    Route::post('/delete','CouponController@delete')->name('coupons.delete');
                    //Route::get('/status/{id}/{status}','CouponController@status')->name('coupons.status')->where('id','[0-9]+')->where('status','[0-1]+');
                    Route::post('/status','CouponController@status')->name('coupons.status');

                   // Route::get('/export','AddonController@exportExcel')->name('addons.export');

                    Route::fallback(function() {
                        return redirect()->route('coupons.index');
                    });
                });

                Route::group([
                    'prefix' => 'reports'
                ], function () {
                    Route::get('/','ReportController@index')->name('reports.index');
                    Route::get('/view/{id}','ReportController@view')->name('reports.view');
                    Route::get('/export','ReportController@exportExcel')->name('reports.export');

                    Route::fallback(function() {
                        return redirect()->route('waiters.index');
                    });
                });

                Route::group([
                    'prefix' => 'orders'
                ], function () {
                    Route::get('/','OrderController@index')->name('orders.index');
                    Route::get('/view/{id}','OrderController@view')->name('orders.view');
                    Route::get('/export','OrderController@exportExcel')->name('order.export');
                    Route::post('/order-delete','OrderController@singledelete')->name('orderssingledelete');
                    Route::fallback(function() {
                        return redirect()->route('orders.index');
                    });
                });

                Route::group([
                    'prefix' => 'claims'
                ], function () {
                    Route::get('/','ClaimController@index')->name('claims.index');
                    Route::get('/view/{id}','ClaimController@view')->name('claims.view');
                    //Route::get('/delete/{id}','ClaimController@delete')->name('claims.delete');
                    Route::post('/delete','ClaimController@delete')->name('claims.delete');
                    Route::get('/status','ClaimController@updateStatus')->name('claims.updateStatus');
                    Route::get('/resolutionupdate','ClaimController@resolutionupdate')->name('claims.resolutionupdate');

                    Route::fallback(function() {
                        return redirect()->route('orders.index');
                    });
                });


                Route::group([
                    'prefix' => 'faqs'
                ], function () {
                    Route::get('/','FaqController@index')->name('faqs.index');
                    Route::get('/add','FaqController@single')->name('faqs.single');
                    Route::post('/add','FaqController@create')->name('faqs.create');
                    Route::get('/edit/{id}','FaqController@showEditForm')->name('faqs.editForm')->where('id','[0-9]+');
                    Route::post('/edit/{id}','FaqController@update')->name('faqs.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','FaqController@delete')->name('faqs.delete')->where('id','[0-9]+');
                    Route::post('/delete','FaqController@delete')->name('faqs.delete');
                });

                Route::group([
                    'prefix' => 'messages'
                ], function () {
                    Route::get('/','MessageController@index')->name('messages.index');
                    Route::get('/add','MessageController@single')->name('messages.single');
                    Route::post('/add','MessageController@create')->name('messages.create');

                    Route::get('/delete/{id}','MessageController@delete')->name('messages.delete')->where('id','[0-9]+');
                });

                Route::group([
                    'prefix' => 'cmspages'
                ], function () {
                    Route::get('/','CmspagesController@index')->name('cmspages.index');
                    Route::get('/add','CmspagesController@single')->name('cmspages.single');
                    Route::post('/add','CmspagesController@create')->name('cmspages.create');
                    Route::get('/edit/{id}','CmspagesController@showEditForm')->name('cmspages.editForm')->where('id','[0-9]+');
                    Route::post('/edit/{id}','CmspagesController@update')->name('cmspages.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','CmspagesController@delete')->name('cmspages.delete')->where('id','[0-9]+');
                    Route::post('/delete','CmspagesController@delete')->name('cmspages.delete');
                    Route::get('/aboutus','CmspagesController@aboutus')->name('cmspages.aboutus');
                    Route::post('/aboutus/update/{id}','CmspagesController@aboutusupdate')->name('cmspages.aboutusupdate');
                });


                Route::group([
                    'prefix' => 'schools'
                ], function () {
                    Route::get('/','SchoolController@index')->name('schools.index');
                    Route::get('/add','SchoolController@single')->name('schools.single');
                    Route::post('/add','SchoolController@create')->name('schools.create');
                    Route::get('/edit/{id}','SchoolController@showEditForm')->name('schools.editForm')->where('id','[0-9]+');
                    Route::post('/edit/{id}','SchoolController@update')->name('schools.update')->where('id','[0-9]+');
                    //Route::get('/delete/{id}','SchoolController@delete')->name('schools.delete')->where('id','[0-9]+');
                    Route::post('/delete','SchoolController@delete')->name('schools.delete');


                    Route::get('/edit-availability-editForm/{id}','SchoolController@showEditAvailabilityForm')->name('schools.availability_editForm')->where('id','[0-9]+');
                    
                    Route::post('/update-availability/{id}','SchoolController@updateAvailability')->name('schools.update_availability')->where('id','[0-9]+');

                    Route::get('/add-availability','SchoolController@addAvailability')->name('schools.add_availability');

                    Route::get('/single-availability','SchoolController@singleAvailability')->name('schools.single_vailability');

                    Route::post('/create-availability','SchoolController@createAvailability')->name('schools.create_availability');

                    Route::post('/delete-availability','SchoolController@deleteAvailability')->name('schools.availability_delete');
                });

                Route::group([
                    'prefix' => 'buildings'
                ], function () {
                    Route::get('/','BuildingController@index')->name('buildings.index');
                    Route::get('/add','BuildingController@single')->name('buildings.single');
                    Route::post('/add','BuildingController@create')->name('buildings.create');
                    Route::get('/edit/{id}','BuildingController@showEditForm')->name('buildings.editForm')->where('id','[0-9]+');
                    Route::post('/edit/{id}','BuildingController@update')->name('buildings.update')->where('id','[0-9]+');
                    Route::get('/delete/{id}','BuildingController@delete')->name('buildings.delete')->where('id','[0-9]+');
                });

                Route::group([
                    'prefix' => 'billing'
                ], function () {
                    Route::get('all','TransactionController@index')->name('transactions.index');
                    Route::get('/view/{id}','TransactionController@view')->name('transactions.view');
                    Route::get('today', 'TransactionController@today')->name('transactions.indexDaily');
                    Route::get('monthly', 'TransactionController@monthly')->name('transactions.monthly');

                    Route::get('yearly', 'TransactionController@yearly')->name('transactions.year');

                    Route::get('charge/{id}', 'TransactionController@charge')->name('transactions.charge');


                });

                Route::group([
                    'prefix' => 'orders'
                ], function () {
                    Route::get('/','OrderController@index')->name('orders.index');
                    // Route::get('/')
                    Route::get('/laundry','OrderController@laundryorders')->name('orders.laundry');

                    Route::get('/all/{type?}','OrderController@allorders')->name('orders.all');
                    Route::get('/housekeeping','OrderController@housekeepingorders')->name('orders.housekeep');
                    Route::get('/storage','OrderController@storageorders')->name('orders.storage');

                    Route::get('/view/{id}','OrderController@view')->name('orders.view');

                    Route::get('/updateStatus','OrderController@updateStatus')->name('orders.updateStatus');

                    Route::get('/status/{id}','OrderController@view')->name('orders.single.status');

                    Route::get('/delete/{id}','OrderController@delete')->name('orders.delete')->where('id','[0-9]+');
                    Route::get('/delete/{id}','OrderController@sngledelete')->name('orders.single.delete')->where('id','[0-9]+');
                    Route::get('/assignOrder','OrderController@assignOrder')->name('orders.assignOrder');
                });

                Route::group([
                    'prefix' => 'schedule'
                ], function () {

                    Route::get('/','ScheduleController@index')->name('scheduler.index');
                    // Route::get('/','ScheduleController@index')->name('scheduler.index');
                    Route::post('/today-view-orderlist','ScheduleController@viewOrder')->name('scheduler.viewOrders');
                    Route::get('/today-view-orders/{date}','ScheduleController@orderlistview')->name('scheduler.orderlist');

                });

                Route::group([
                    'prefix' => 'laundrylogs'
                ], function () {
                    Route::get('/','LaundryLogController@index')->name('laundrylogs.index');
                    Route::get('/inventory-index','LaundryLogController@inventoryindex')->name('laundrylogs.inventoryindex');

                    Route::get('/overweight-index','LaundryLogController@overweightindex')->name('laundrylogs.overweightindex');
                    Route::get('/overweight-add','LaundryLogController@overweightsingle')->name('laundrylogs.overweightsingle');

                    Route::get('/overweight-edit/{id}','LaundryLogController@overweightshowupdate')->name('laundrylogs.overweightshowupdate');

                    Route::post('/overweight-create','LaundryLogController@overweightcreate')->name('laundrylogs.overweightcreate');

                    Route::get('/inventory-view/{id}','LaundryLogController@inventoryview')->name('laundrylogs.viewinventory');
                    Route::get('/printable-laundrylogs','LaundryLogController@printableData')->name('laundrylogs.printable');

                    Route::get('/add','LaundryLogController@single')->name('laundrylogs.single');

                    Route::get('/getorderdetails','LaundryLogController@getorderdetails')->name('laundrylogs.getorderdetails');

                    Route::post('/add','LaundryLogController@create')->name('laundrylogs.create');

                    Route::get('/edit/{id}','LaundryLogController@showEditForm')->name('laundrylogs.showupdate')->where('id','[0-9]+');

                    Route::post('/edit/{id}','LaundryLogController@update')->name('laundrylogs.update')->where('id','[0-9]+');
                    Route::post('/overweigh-update/{id}','LaundryLogController@overweightupdate')->name('laundrylogs.overweightupdate')->where('id','[0-9]+');

                    Route::post('/delete','LaundryLogController@delete')->name('laundrylogs.delete');
                    Route::post('/overweightdelete-delete','LaundryLogController@overweightdelete')->name('laundrylogs.overweightdelete');
                    //Route::get('/delete/{id}','LaundryLogController@delete')->name('laundrylogs.delete')->where('id','[0-9]+');

                    Route::get('/getDrycleanTotal','LaundryLogController@getDrycleanTotal')->name('getDrycleanTotal');

                    Route::get('/exportExcel','LaundryLogController@exportExcel')->name('laundrylogs.export');

                });
                 Route::group([
                    'prefix' => 'reveiw'
                ], function () {

                        Route::get('/storage.review','StoragePlanController@storageReview')->name('storage.review');
                        Route::get('/printable-storage-review','StoragePlanController@printableStorageReview')->name('printable_storage.review');
                        Route::Match(['Post','Get'],'/storage.review.update','StoragePlanController@StorageReviewupdate')->name('storage.review.update');
                    });

                  Route::group([
                    'prefix' => 'cancelations'
                ], function () {

                        Route::get('/subscription.cancelations','CancelSubscriptionsController@index')->name('subscription.cancelations');
                        Route::get('/printable-subscription','CancelSubscriptionsController@printableCancelation')->name('printable_subscription.cancelations');
                        Route::get('/view/{id}','CancelSubscriptionsController@view')->name('subscription.view');
                        Route::post('/cancelations','CancelSubscriptionsController@update')->name('cancelations.update');

                    });

                    Route::group([
                    'prefix' => 'fees'
                    ], function () {

                        Route::get('/manage-fee','FeesController@index')->name('fees');
                        Route::get('/manage-printable-fee','FeesController@printableFees')->name('printable.fees');
                        Route::Match(['Get','Post'],'fees-update/{id}','FeesController@update')->name('fees.update');
                        Route::Match(['Get','Post'],'fees-delete','FeesController@delete')->name('fees.delete');
                        Route::get('add/fees','FeesController@single')->name('fees.single');
                        Route::post('add/create','FeesController@create')->name('fees.create');

                    });

                    Route::group([
                    'prefix' => 'tax'
                    ], function () {

                        Route::get('/tax-fee','FeesController@taxindex')->name('tax_fees.index');
                        Route::get('/manage-printable-fee','FeesController@printableFees')->name('printable.fees');
                        Route::Match(['Get','Post'],'tax-update/{id}','FeesController@taxupdate')->name('tax_fees.update');
                        Route::Match(['Get','Post'],'tax-delete','FeesController@taxdelete')->name('tax_fees.delete');
                        Route::get('add/tax-fees','FeesController@taxsingle')->name('tax_fees.single');
                        Route::post('add/tax-create','FeesController@taxcreate')->name('tax_fees.create');

                    });

                    Route::group([
                    'prefix' => 'thanksPage'
                    ], function () {
                        Route::get('/','ThanksController@index')->name('thanks');
                        Route::get('/laundry/{service}','ThanksController@laundryindex')->name('laundrythanks');

                        Route::post('update/{id}','ThanksController@update')->name('thanks.update');

                        Route::post('service-update-thanks/{id}','ThanksController@thanksServiceUpdate')->name('thanks_service.update');

                        Route::get('/service-laundry','ThanksController@serviceLaundryindex')->name('thanks.laundry_service');

                        Route::get('/service-housekeeping','ThanksController@serviceHousekeepingindex')->name('thanks.housekeeping_service');

                        Route::get('/service-storage','ThanksController@serviceStorageindex')->name('thanks.storage_service');

                        Route::get('/service-laundry-housekeeping','ThanksController@serviceLaundryHousekeepingindex')->name('thanks.laundry_housekeeping');

                        Route::post('service-update/{id}','ThanksController@serviceUpdate')->name('thanks.serviceupdate');

                        Route::get('school-index','ThanksController@schoolsThanksPage')->name('thanks.school_thanks');

                        Route::get('school-thanks-update/{schoo_id}','ThanksController@schoolsThanksPageUpdate')->name('thanks.schoolthanksupdate');
                        Route::get('school-thanks-update/{id}','ThanksController@schoolsThanksPageForms')->name('thanks.schoolthanksupdateform');
                        

                        Route::post('school-thanks-updatedpages/{id}','ThanksController@schoolThanksUpdatePage')->name('thanks.schoolthanksupdatedPages');
                    });

                    Route::group([
                    'prefix' => 'referfriend'
                    ], function () {
                        Route::get('/index/{id}','ReferAFriend@editReferFriends')->name('referfriend.sales.button');
                        Route::post('update/{id}','ReferAFriend@update')->name('referfriend.update'); 
                    });

                    Route::group([
                    'prefix' => 'prefferences'
                    ], function () {
                        Route::get('/{id}','PrefferenceController@index')->name('prefferences.button');
                        Route::post('update/{id}','PrefferenceController@update')->name('prefferences.update'); 
                    });


                    Route::group([
                    'prefix' => 'How it work'
                    ], function () {
                        Route::get('/','HowitworkController@index')->name('how_it_work');
                        Route::get('/how-it-works/{type}','HowitworkController@howitworkForms')->name('how_it_work.form');
                        Route::get('/how-it-work/{type}','HowitworkController@howitworkLaundryIndex')->name('how_it_work.index');
                        Route::post('/how-it-work/create','HowitworkController@create')->name('how_it_work.create');
                        Route::get('/edit/{id}/{type}','HowitworkController@editForm')->name('how_it_work.edit');
                        Route::post('/update/{id}/{type}','HowitworkController@update')->name('how_it_work.update');
                        Route::post('/delete','HowitworkController@delete')->name('how_it_work.delete');
                    });

                    Route::group([
                    'prefix' => 'insurance', 
                        ], function () {
                        Route::get('/','InsuranceController@index')->name('insurance.index'); 
                        Route::get('/plan-index','InsuranceController@planIndex')->name('insurance.planindex'); 
                        Route::get('/plan-edit/{id}','InsuranceController@planedit')->name('insurance.planedit'); 
                        Route::post('/plan-update/{id}','InsuranceController@editupdateplan')->name('insurance.planeditupdate'); 
                        Route::get('/single','InsuranceController@single')->name('insurance.single'); 
                        Route::post('/create','InsuranceController@create')->name('insurance.create'); 
                        Route::get('/edit/{id}','InsuranceController@editForm')->name('insurance.editForm'); 
                        Route::post('/edit/{id}','InsuranceController@updateplan')->name('insurance.update'); 
                        Route::post('/delete','InsuranceController@delete')->name('insurance.delete'); 

                        //Route::post('/edit/{id}','InsuranceController@updatePlan
                          //  ')->name('insurance.update'); 
                    });

                    Route::group([
                    'prefix' => 'contactus', 
                        ], function () {
                        Route::get('/','ContactusController@index')->name('contactus.index'); 
                         
                        Route::post('/delete','ContactusController@delete')->name('contactus.delete'); 

                        //Route::post('/edit/{id}','InsuranceController@updatePlan
                          //  ')->name('insurance.update'); 
                    });


            });

});


Route::group([
            'prefix' => 'staff',
            //'namespace' => 'Staff',
            'as'=>'staff.'
        ], function () {

            Route::get('/login','Staff\StaffController@showlogin')->name('showlogin');
            Route::post('/login','Staff\StaffController@login')->name('login');

            Route::group([
                'middleware' => ['auth:staff','assign.guard:staff'],
            ], function () {

                Route::get('/home','Staff\StaffController@home')->name('home');
                Route::get('/profile','Staff\StaffController@showProfile')->name('profile.show');
                Route::post('/profile','Staff\StaffController@updateProfile')->name('profile.update');
                Route::get('/password','Staff\StaffController@showPassword')->name('password.show');
                Route::post('/password','Staff\StaffController@updatePassword')->name('password.update');
                Route::get('/logout','Staff\StaffController@logout')->name('logout');


                Route::group([
                    'prefix' => 'laundrylogs',
                    'namespace' => 'Staff',
                ], function () {
                    Route::get('/','LaundryLogController@index')->name('laundrylogs.index');

                    Route::get('/add','LaundryLogController@single')->name('laundrylogs.single');

                    Route::get('/getorderdetails','LaundryLogController@getorderdetails')->name('laundrylogs.getorderdetails');

                    Route::post('/add','LaundryLogController@create')->name('laundrylogs.create');

                    Route::get('/edit/{id}','LaundryLogController@showEditForm')->name('laundrylogs.showupdate')->where('id','[0-9]+');

                    Route::post('/edit/{id}','LaundryLogController@update')->name('laundrylogs.update')->where('id','[0-9]+');

                    Route::get('/delete/{id}','LaundryLogController@delete')->name('laundrylogs.delete')->where('id','[0-9]+');

                    Route::get('/getDrycleanTotal','LaundryLogController@getDrycleanTotal')->name('getDrycleanTotal');

                    Route::get('/exportExcel','LaundryLogController@exportExcel')->name('laundrylogs.export');

                });

               /* Route::group([
                    'prefix' => 'orders',
                    'namespace' => 'Admin'
                ], function () {
                    Route::get('/','OrderController@index')->name('orders.index');
                    // Route::get('/')
                    Route::get('/laundry','OrderController@laundryorders')->name('orders.laundry');

                    Route::get('/all/{type?}','OrderController@allorders')->name('orders.all');
                    Route::get('/housekeeping','OrderController@housekeepingorders')->name('orders.housekeep');
                    Route::get('/storage','OrderController@storageorders')->name('orders.storage');

                    Route::get('/view/{id}','OrderController@view')->name('orders.view');

                    Route::get('/updateStatus','OrderController@updateStatus')->name('orders.updateStatus');

                    Route::get('/status/{id}','OrderController@view')->name('orders.single.status');

                    Route::get('/delete/{id}','OrderController@delete')->name('orders.delete')->where('id','[0-9]+');
                    Route::get('/delete/{id}','OrderController@sngledelete')->name('orders.single.delete')->where('id','[0-9]+');
                    
                    Route::get('/assignOrder','OrderController@assignOrder')->name('orders.assignOrder');
                });*/
                 Route::group([
                    'prefix' => 'orders'
                ], function () {
                    Route::get('/','Staff\OrderController@index')->name('orders.index');
                    // Route::get('/')
                    Route::get('/laundry','Staff\OrderController@laundryorders')->name('orders.laundry');

                    Route::get('/all/{type?}','Staff\OrderController@allorders')->name('orders.all');
                    Route::get('/housekeeping','Staff\OrderController@housekeepingorders')->name('orders.housekeep');
                    Route::get('/storage','Staff\OrderController@storageorders')->name('orders.storage');

                    Route::get('/view/{id}','Staff\OrderController@view')->name('orders.view');

                    Route::get('/updateStatus','Staff\OrderController@updateStatus')->name('orders.updateStatus');

                    Route::get('/status/{id}','Staff\OrderController@view')->name('orders.single.status');

                    Route::get('/delete/{id}','Staff\OrderController@delete')->name('orders.delete')->where('id','[0-9]+');
                    Route::get('/delete/{id}','Staff\OrderController@sngledelete')->name('orders.single.delete')->where('id','[0-9]+');
                    Route::get('/assignOrder','Staff\OrderController@assignOrder')->name('orders.assignOrder');
                });
                Route::group([
                    'prefix' => 'users',
                    //'namespace' => 'Admin'
                ],function(){
                    Route::get('/','Admin\UserController@index')->name('users.indexs');
                    Route::get('/add', 'Admin\UserController@single')->name('users.single');
                    Route::post('/add', 'Admin\UserController@create')->name('users.create');
                    Route::get('/edit/{id}', 'Admin\UserController@showEditForm')->name('users.edit')->where('id','[0-9]+');
                    Route::post('/edit/{id}', 'Admin\UserController@update')->name('users.update')->where('id','[0-9]+');
                    Route::get('/view/{id}', 'Admin\UserController@view')->name('users.view')->where('id','[0-9]+');
                    Route::post('delete', 'Admin\UserController@delete')->name('users.delete')/*->where('id','[0-9]+')*/;
                    //Route::get('/status/{id?}/{status?}','UserController@status')->name('users.status')->where('id','[0-9]+')->where('status','[0-9]+');
                    Route::post('status','Admin\UserController@status')->name('users.status');
                    Route::get('/export','Admin\UserController@exportExcel')->name('users.export');

                });

                Route::group([
                    'prefix' => 'schedule',
                    'namespace' => 'Admin'
                ], function () {

                    Route::get('/','ScheduleController@index')->name('scheduler.index');
                    // Route::get('/','ScheduleController@index')->name('scheduler.index');
                    Route::post('/today-view-orderlist','ScheduleController@viewOrder')->name('scheduler.viewOrders');
                    Route::get('/today-view-orders/{date}','ScheduleController@orderlistview')->name('scheduler.orderlist');

                });

                Route::group([
                    'prefix' => 'claims',
                    'namespace' => 'Admin'
                ], function () {
                    Route::get('/','ClaimController@index')->name('claims.index');
                    Route::get('/view/{id}','ClaimController@view')->name('claims.view');
                    //Route::get('/delete/{id}','ClaimController@delete')->name('claims.delete');
                    Route::post('/delete','ClaimController@delete')->name('claims.delete');
                    Route::get('/status','ClaimController@updateStatus')->name('claims.updateStatus');
                    Route::get('/resolutionupdate','ClaimController@resolutionupdate')->name('claims.resolutionupdate');

                    Route::fallback(function() {
                        return redirect()->route('orders.index');
                    });
                });
                Route::group([
                    'prefix' => 'laundrylogs',
                     'namespace' => 'Admin'
                ], function () {
                    Route::get('/','LaundryLogController@index')->name('laundrylogs.index');
                    Route::get('/printable-laundrylogs','LaundryLogController@printableData')->name('laundrylogs.printable');

                    Route::get('/add','LaundryLogController@single')->name('laundrylogs.single');

                    Route::get('/getorderdetails','LaundryLogController@getorderdetails')->name('laundrylogs.getorderdetails');

                    Route::post('/add','LaundryLogController@create')->name('laundrylogs.create');

                    Route::get('/edit/{id}','LaundryLogController@showEditForm')->name('laundrylogs.showupdate')->where('id','[0-9]+');

                    Route::post('/edit/{id}','LaundryLogController@update')->name('laundrylogs.update')->where('id','[0-9]+');

                    Route::post('/delete','LaundryLogController@delete')->name('laundrylogs.delete');
                    //Route::get('/delete/{id}','LaundryLogController@delete')->name('laundrylogs.delete')->where('id','[0-9]+');

                    Route::get('/getDrycleanTotal','LaundryLogController@getDrycleanTotal')->name('getDrycleanTotal');

                    Route::get('/exportExcel','LaundryLogController@exportExcel')->name('laundrylogs.export');

                });
                
                Route::group([
                    'prefix' => 'emergency',
                    'namespace' => 'Admin'
                ],function(){
                    Route::get('/','EmergencyMessageController@usersindex')->name('emergencymessage.usersindex'); 
                    Route::get('/add-users','EmergencyMessageController@single')->name('emergencymessage.usersadd'); 
                    Route::post('/add-users','EmergencyMessageController@create')->name('emergencymessage.create'); 
                    Route::post('/delete-users','EmergencyMessageController@usersdelete')->name('emergencymessage.usersdelete'); 
                    Route::get('/update-users/{id}','EmergencyMessageController@showUserEditForm')->name('emergencymessage.usersupdate'); 
                    Route::post('/update-users','EmergencyMessageController@usersmessageUpdate')->name('emergencymessage.usersmessageupdate'); 

                    Route::get('/messages-school','EmergencyMessageController@schoolindex')->name('emergencymessage.schoolindex'); 
                    Route::get('/add-school','EmergencyMessageController@schoolform')->name('emergencymessage.schoolform'); 
                    Route::post('/add','EmergencyMessageController@schoolcreate')->name('emergencymessage.school_create'); 
                    Route::post('/delete-school','EmergencyMessageController@schooldelete')->name('emergencymessage.schooldeteled'); 
                    Route::post('/update-school','EmergencyMessageController@schoolupdate')->name('emergencymessage.school_update'); 

                    Route::get('/update-school-message/{id}','EmergencyMessageController@showSchoolEditForm')->name('emergencymessage.showSchoolEditform'); 
                    Route::post('/update-users','EmergencyMessageController@usersmessageUpdate')->name('emergencymessage.usersmessageupdate');  
                    Route::fallback(function() {
                        return redirect()->route('housekeepingplans.index');
                    });
                });

                 

                  Route::group([
                    'prefix' => 'cancelations',
                    'namespace' => 'Admin'
                ], function () {

                        Route::get('/subscription.cancelations','CancelSubscriptionsController@index')->name('subscription.cancelations');
                        Route::get('/printable-subscription','CancelSubscriptionsController@printableCancelation')->name('printable_subscription.cancelations');
                        Route::get('/view/{id}','CancelSubscriptionsController@view')->name('subscription.view');
                        Route::post('/cancelations','CancelSubscriptionsController@update')->name('cancelations.update');

                    });

                Route::group([
                    'prefix' => 'billing',
                    'namespace' => 'Admin'
                ], function () {
                    Route::get('all','TransactionController@index')->name('transactions.index');
                    Route::get('/view/{id}','TransactionController@view')->name('transactions.view');
                    Route::get('today', 'TransactionController@today')->name('transactions.indexDaily');
                    Route::get('monthly', 'TransactionController@monthly')->name('transactions.monthly');

                    Route::get('yearly', 'TransactionController@yearly')->name('transactions.year');

                    Route::get('charge/{id}', 'TransactionController@charge')->name('transactions.charge');


                });

            });
});


Route::group([
        'prefix' => 'web',
        'namespace' => 'Web',
    ], function () {

        Route::get('/register','HomeController@register')->name('web.register');
        Route::get('/home','HomeController@home')->name('web.home');
        Route::get('/setsession','HomeController@setsession')->name('setsession');

        Route::get('/aboutus','HomeController@aboutus')->name('web.aboutus');
        Route::get('/getservice','HomeController@getservice')->name('web.getservice');
        Route::get('/contactus','HomeController@contactus')->name('web.contactus');
        Route::get('/policies','HomeController@policies')->name('web.policies');
        Route::get('/terms','HomeController@terms')->name('web.terms');
        Route::get('/housekeeping','HomeController@housekeeping')->name('web.housekeeping');
        Route::get('/storage','HomeController@storage')->name('web.storage');
        Route::get('/faq','HomeController@faq')->name('web.faq');
        Route::get('/classSchedule','HomeController@classSchedule')->name('classSchedule');

        Route::group(['middleware' => 'assignAuth'], function () {
            Route::get('/profile','HomeController@profile')->name('web.profile');
            Route::get('/destroysession','HomeController@destroysession')->name('destroysession');
            Route::get('/completeBooking/{service}/{plan_id}','HomeController@completeBooking')->name('web.completeBooking');
            Route::get('/cart','HomeController@cart')->name('web.cart');
            Route::get('/setCartSession','HomeController@setCartSession')->name('setCartSession');
            Route::get('/destroyCartsession','HomeController@destroyCartsession')->name('destroyCartsession');
            Route::get('/cancel/{id}','HomeController@cancel')->name('web.cancel');

        });

});


