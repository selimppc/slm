<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 1/14/16
 * Time: 3:59 PM
 */

Route::group(array('middleware' => 'auth','modules'=>'Admin', 'namespace' => 'App\Modules\Admin\Controllers'), function() {
    //Your routes belong to this module.
/*Form Components*/
Route::get('form-elements', function () {
    return view('admin::layouts.example_pages.form_elements');
});

/* Form Sample For Registration*/
Route::get('reg-sample', function () {
    return view('admin::layouts.example_pages.reg_form');
});

Route::any('admin', [
    'as' => 'admin',
    'uses' => 'AdminController@index'
]);

Route::any('content-page', [
    'as' => 'content-page',
    'uses' => 'AdminController@content_page'
]);


Route::any('validation-page', [
    'as' => 'validation-page',
    'uses' => 'AdminController@validation_page'
]);

Route::any('homer', [
    'as' => 'homer',
    'uses' => 'AdminController@homer'
]);


//Bord...............

    Route::any('bord', [
        'as' => 'bord',
        'uses' => 'BordController@bord_index'
    ]);

    Route::any('channel', [
        'as' => 'channel',
        'uses' => 'BordController@channel'
    ]);
    Route::any('store-channel', [
        'as' => 'store-channel',
        'uses' => 'BordController@store_channel'
    ]);

    Route::any('achtergrond', [
        'as' => 'achtergrond',
        'uses' => 'BordController@achtergrond'
    ]);

    Route::any('lichtbakken', [
        'as' => 'lichtbakken',
        'uses' => 'BordController@lichtbakken'
    ]);

    Route::any('store-lichtbakken', [
        'as' => 'store-lichtbakken',
        'uses' => 'BordController@store_lichtbakken'
    ]);


    /*------------Notify by Admin-------------*/


    Route::any('notify-safety', [
        'as' => 'notify-safety',
        'uses' => 'NotificationController@update_safety'
    ]);


    Route::any('notify-cabin', [
        'as' => 'notify-cabin',
        'uses' => 'NotificationController@update_cabin'
    ]);

    Route::any('notify-confidential', [
        'as' => 'notify-confidential',
        'uses' => 'NotificationController@update_confidential'
    ]);

    Route::any('notify-dangerous', [
        'as' => 'notify-dangerous',
        'uses' => 'NotificationController@update_dangerous'
    ]);

    Route::any('notify-ground', [
        'as' => 'notify-ground',
        'uses' => 'NotificationController@update_ground'
    ]);

    Route::any('notify-maintenance', [
        'as' => 'notify-maintenance',
        'uses' => 'NotificationController@update_maintenance'
    ]);


















});

