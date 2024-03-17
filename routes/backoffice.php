<?php


/**
 *
 * ------------------------------------
 * Backoffice Routes
 * ------------------------------------
 *
 */
Route::group(['middleware' => "backoffice.guest", 'as' => "auth." ], function(){
    Route::get('login',['as' => "login", 'uses' => "LoginController@login"]);
    Route::post('login',['uses' => "LoginController@authenticate"]);
    Route::get('register',['as' => "register", 'uses' => "RegisterController@register"]);
    Route::post('register',['uses' => "RegisterController@authenticate"]);
    Route::get('{username}/verify',['as' => "verify", 'uses' => "RegisterController@verify"]);

    Route::get('forgot-password',['as' => "forgotPass", 'uses' => "ForgotPasswordController@forgotPass"]);
    Route::post('forgot-password',['uses' => "ForgotPasswordController@resetLink"]);

    Route::get('reset-password/{token}',['as' => "resetPass", 'uses' => "ForgotPasswordController@resetPass"]);
    Route::post('reset-password/{token}',['uses' => "ForgotPasswordController@updatePass"]);

    Route::any('auto-reply',['as' => "autoReply",'uses' => "ChatBotController@autoReply"]);
    
});

Route::group(['middleware' => ["backoffice.auth"
// , "backoffice.verifiedOnly"
]], function(){
    Route::get('logout',['as' => "logout",'uses' => "LoginController@logout"]);
    Route::get('/',['as' => "index",'uses' => "DashboardController@index"]);
    Route::any('download/{start?}/{end?}',['as' => "download",'uses' => "DashboardController@downloadReport"]);
    Route::any('viewReport',['as' => "viewReport",'uses' => "DashboardController@viewReport"]);

    Route::group(['as' => "patients.", 'prefix' => "patients"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@create"]);
        Route::post('create',['middleware' => "backoffice.superUserOnly", 'uses' => "PatientsController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "PatientsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "PatientsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "PatientsController@update"]);

        Route::get('create-treatment/{id}',['as' => "create_treatment",'uses' => "TreatmentsController@create"]);
        Route::get('view-treatment/{id}',['as' => "view_treatment",'uses' => "TreatmentsController@view"]);
        Route::post('view-treatment/{id}',['uses' => "TreatmentsController@save"]);
    });

    Route::group(['as' => "chatbot.", 'prefix' => "chatbot"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "ChatBotController@index"]);
        Route::post('/',['middleware' => "backoffice.superUserOnly", 'uses' => "ChatBotController@create"]);
        Route::any('auto-reply',['as' => "autoReply",'uses' => "ChatBotController@autoReply"]);

        Route::post('train',['as' => "train", 'middleware' => "backoffice.superUserOnly", 'uses' => "ChatBotController@train"]);
    });

    Route::group(['as' => "services.", 'prefix' => "services"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@create"]);
        Route::post('create',['middleware' => "backoffice.superUserOnly", 'uses' => "ServicesController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "ServicesController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "ServicesController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "ServicesController@update"]);

        Route::get('{id}/type/add',['as' => "addType",'uses' => "ServicesController@addType"]);
        Route::post('{id}/type/add',['uses' => "ServicesController@saveType"]);
        Route::get('type/edit/{id}',['as' => "editType",'uses' => "ServicesController@editType"]);
        Route::post('type/edit/{id}',['uses' => "ServicesController@updateType"]);
        Route::get('type/delete/{id}',['as' => "deleteType",'uses' => "ServicesController@deleteType"]);

        Route::any('types',['as' => "serviceTypes",'uses' => "ServicesController@serviceTypes"]);
        Route::any('type-detail',['as' => "serviceTypeDetail",'uses' => "ServicesController@serviceTypeDetail"]);
    });

    Route::group(['as' => "faqs.", 'prefix' => "faqs"], function(){
        Route::get('/',['as' => "index", 'middleware' => "backoffice.superUserOnly", 'uses' => "FAQsController@index"]);
        Route::get('create',['as' => "create", 'middleware' => "backoffice.superUserOnly", 'uses' => "FAQsController@create"]);
        Route::post('create',['middleware' => "backoffice.superUserOnly", 'uses' => "FAQsController@store"]);
        Route::get('view/{id}',['as' => "view",'uses' => "FAQsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "FAQsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "FAQsController@update"]);
    });

    Route::group(['as' => "appointments.", 'prefix' => "appointments"], function(){
        Route::get('/',['as' => "index", 'uses' => "AppointmentsController@index"]);
        Route::get('create',['as' => "create", 'uses' => "AppointmentsController@create"]);
        Route::post('create',['uses' => "AppointmentsController@store"]);
        Route::get('delete/{id}',['as' => "delete",'uses' => "AppointmentsController@delete"]);
        Route::get('view/{id}',['as' => "view",'uses' => "AppointmentsController@view"]);
        Route::get('edit/{id}',['as' => "edit",'uses' => "AppointmentsController@edit"]);
        Route::post('edit/{id}',['as' => "update",'uses' => "AppointmentsController@update"]);
    });

    Route::group(['as' => "account.", 'prefix' => "account"], function(){
        Route::get('/',['as' => "index", 'uses' => "AccountController@index"]);
        Route::post('/',['as' => "save", 'uses' => "AccountController@save"]);
        Route::post('update-password',['as' => "update_password", 'uses' => "AccountController@updatePassword"]);
    });

});
