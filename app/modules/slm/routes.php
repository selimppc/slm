<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */

Route::group(array('modules'=>'Slm', 'namespace' => 'App\Modules\Slm\Controllers'), function() {

/*----Air Safety-----------------*/

    Route::any('safety-search', [
        //'middleware' => 'acl_access:role',
        'as' => 'safety-search',
        'uses' => 'SafetyController@air_safety_info'
    ]);


    Route::any('air-safety', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'air-safety',
        'uses' => 'SafetyController@air_safety_info'
    ]);

    Route::any('safety-form', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'safety-form',
        'uses' => 'SafetyController@safety_add_info'
    ]);

    Route::any('store-safety', [
        //'middleware' => 'acl_access:store-safety',
        'as' => 'store-safety',
        'uses' => 'SafetyController@store_safety'
    ]);

    Route::any('view-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'view-csv',
        'uses' => 'SafetyController@csv'
    ]);

    Route::any('view-safety/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'view-safety',
        'uses' => 'SafetyController@show'
    ]);

    Route::any('upd-safety/{id}', [
        //'middleware' => 'acl_access:edit-role/{slug}',
        'as' => 'upd-safety',
        'uses' => 'SafetyController@edit'
    ]);

    Route::any('update-safety/{id}', [
        //'middleware' => 'acl_access:update-role/{slug}',
        'as' => 'update-safety',
        'uses' => 'SafetyController@update'
    ]);

    Route::any('delete-safety/{id}', [
        //'middleware' => 'acl_access:delete-role/{slug}',
        'as' => 'delete-safety',
        'uses' => 'SafetyController@destroy'
    ]);


/*----Air Safety-----------------*/


/*----Pdf Manager-----------------*/

    Route::any('pdf-search', [
        //'middleware' => 'acl_access:role',
        'as' => 'pdf-search',
        'uses' => 'PdfManagerController@index'
    ]);

    Route::any('safety-bulletin', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'safety-bulletin',
        'uses' => 'PdfManagerController@index'
    ]);

    Route::any('alerts', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'alerts',
        'uses' => 'PdfManagerController@index_alerts'
    ]);


    Route::any('safety-manuals', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'safety-manuals',
        'uses' => 'PdfManagerController@index_safety'
    ]);


    Route::any('pdf-form', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'pdf-form',
        'uses' => 'PdfManagerController@pdf_add_info'
    ]);

    Route::any('pdf-alert', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'pdf-alert',
        'uses' => 'PdfManagerController@pdf_add_info_alert'
    ]);

    Route::any('pdf-safetyadd', [
        //'middleware' => 'acl_access:air-safety',
        'as' => 'pdf-safetyadd',
        'uses' => 'PdfManagerController@pdf_add_info_safety'
    ]);

    Route::any('store-pdf', [
        //'middleware' => 'acl_access:store-safety',
        'as' => 'store-pdf',
        'uses' => 'PdfManagerController@store_pdf'
    ]);

    Route::any('view-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'view-pdf',
        'uses' => 'PdfManagerController@show'
    ]);



    Route::any('edit-alert/{id}', [
        //'middleware' => 'acl_access:edit-role/{slug}',
        'as' => 'edit-alert',
        'uses' => 'PdfManagerController@edit_alert'
    ]);

    Route::any('edit-safety/{id}', [
        //'middleware' => 'acl_access:edit-role/{slug}',
        'as' => 'edit-safety',
        'uses' => 'PdfManagerController@edit_safety'
    ]);

    Route::any('edit-pdf/{id}', [
        //'middleware' => 'acl_access:edit-role/{slug}',
        'as' => 'edit-pdf',
        'uses' => 'PdfManagerController@edit'
    ]);

    Route::any('update-pdf/{id}', [
        //'middleware' => 'acl_access:update-role/{slug}',
        'as' => 'update-pdf',
        'uses' => 'PdfManagerController@update'
    ]);

    Route::any('delete-pdf/{id}', [
        //'middleware' => 'acl_access:delete-role/{slug}',
        'as' => 'delete-pdf',
        'uses' => 'PdfManagerController@destroy'
    ]);

    Route::any('delete-files/{id}', [
        //'middleware' => 'acl_access:delete-role/{slug}',
        'as' => 'delete-files',
        'uses' => 'PdfManagerController@destroy_files'
    ]);

/*----Pdf Manager-----------------*/


    /*Cabin Crew Section Start*/
    Route::get('cabin-crew',[
        'as'=>'cabin-crew',
        'uses'=>'CabinCrewController@index',
    ]);
    Route::get('add-cabin-crew',[
        'as'=>'add-cabin-crew',
        'uses'=>'CabinCrewController@create',
    ]);
    Route::post('store-cabin-crew',[
        'as'=>'store-cabin-crew',
        'uses'=>'CabinCrewController@store',
    ]);

    Route::any('cabin-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'cabin-csv',
        'uses' => 'CabinCrewController@csv'
    ]);

    Route::get('view-cabin-crew/{id}',[
        'as'=>'view-cabin-crew',
        'uses'=>'CabinCrewController@show',
    ]);
    Route::get('edit-cabin-crew/{id}',[
        'as'=>'edit-cabin-crew',
        'uses'=>'CabinCrewController@edit',
    ]);
    Route::patch('update-cabin-crew/{id}',[
        'as'=>'update-cabin-crew',
        'uses'=>'CabinCrewController@update',
    ]);
    Route::get('delete-cabin-crew/{id}',[
        'as'=>'delete-cabin-crew',
        'uses'=>'CabinCrewController@destroy',
    ]);
    /*Cabin Crew Section End*/
    /*Confidential Safety Section Start*/
    Route::get('confidential-safety',[
        'as'=>'confidential-safety',
        'uses'=>'ConfidentialSafetyController@index'
    ]);
    Route::get('add-confidential-safety',[
        'as'=>'add-confidential-safety',
        'uses'=>'ConfidentialSafetyController@create'
    ]);
    Route::post('store-confidential-safety',[
        'as'=>'store-confidential-safety',
        'uses'=>'ConfidentialSafetyController@store'
    ]);
    Route::get('view-confidential-safety/{id}',[
        'as'=>'view-confidential-safety',
        'uses'=>'ConfidentialSafetyController@show'
    ]);


    Route::any('confident-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'confident-csv',
        'uses' => 'ConfidentialSafetyController@csv'
    ]);

    Route::get('edit-confidential-safety/{id}',[
        'as'=>'edit-confidential-safety',
        'uses'=>'ConfidentialSafetyController@edit'
    ]);
    Route::patch('update-confidential-safety/{id}',[
        'as'=>'update-confidential-safety',
        'uses'=>'ConfidentialSafetyController@update'
    ]);
    Route::get('delete-confidential-safety/{id}',[
        'as'=>'delete-confidential-safety',
        'uses'=>'ConfidentialSafetyController@destroy'
    ]);
    /*Confidential Safety Section End*/
    /*Operational Safety Section Start*/
    Route::get('operational-safety',[
        'as'=>'operational-safety',
        'uses'=>'OperationalSafetyController@index'
    ]);
    Route::get('add-operational-safety',[
        'as'=>'add-operational-safety',
        'uses'=>'OperationalSafetyController@create'
    ]);
    Route::post('store-operational-safety',[
        'as'=>'store-operational-safety',
        'uses'=>'OperationalSafetyController@store'
    ]);
    Route::get('view-operational-safety/{id}',[
        'as'=>'view-operational-safety',
        'uses'=>'OperationalSafetyController@show'
    ]);

    Route::any('operation-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'operation-csv',
        'uses' => 'OperationalSafetyController@csv'
    ]);


    Route::get('edit-operational-safety/{id}',[
        'as'=>'edit-operational-safety',
        'uses'=>'OperationalSafetyController@edit'
    ]);
    Route::patch('update-operational-safety/{id}',[
        'as'=>'update-operational-safety',
        'uses'=>'OperationalSafetyController@update'
    ]);
    Route::get('delete-operational-safety/{id}',[
        'as'=>'delete-operational-safety',
        'uses'=>'OperationalSafetyController@destroy'
    ]);
    /*Operational Safety Section End*/
    /*Ground Handling Section Start*/
    Route::get('ground-handling',[
        'as'=>'ground-handling',
        'uses'=>'GroundHandlingController@index'
    ]);
    Route::get('add-ground-handling',[
        'as'=>'add-ground-handling',
        'uses'=>'GroundHandlingController@create'
    ]);
    Route::post('store-ground-handling',[
        'as'=>'store-ground-handling',
        'uses'=>'GroundHandlingController@store'
    ]);
    Route::get('view-ground-handling/{id}',[
        'as'=>'view-ground-handling',
        'uses'=>'GroundHandlingController@show'
    ]);


    Route::any('ground-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'ground-csv',
        'uses' => 'GroundHandlingController@csv'
    ]);


    Route::get('edit-ground-handling/{id}',[
        'as'=>'edit-ground-handling',
        'uses'=>'GroundHandlingController@edit'
    ]);
    Route::patch('update-ground-handling/{id}',[
        'as'=>'update-ground-handling',
        'uses'=>'GroundHandlingController@update'
    ]);
    Route::get('delete-ground-handling/{id}',[
        'as'=>'delete-ground-handling',
        'uses'=>'GroundHandlingController@destroy'
    ]);
    /*Ground Handling Section End*/
    /*Maintenance Occurrence Section Start*/
    Route::get('maintenance-occurrence',[
        'as'=>'maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@index'
    ]);
    Route::get('add-maintenance-occurrence',[
        'as'=>'add-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@create'
    ]);
    Route::post('store-maintenance-occurrence',[
        'as'=>'store-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@store'
    ]);
    Route::get('view-maintenance-occurrence/{id}',[
        'as'=>'view-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@show'
    ]);


    Route::any('maintenance-csv', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'maintenance-csv',
        'uses' => 'MaintenanceOccurrenceController@csv'
    ]);


    Route::get('edit-maintenance-occurrence/{id}',[
        'as'=>'edit-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@edit'
    ]);
    Route::patch('update-maintenance-occurrence/{id}',[
        'as'=>'update-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@update'
    ]);
    Route::get('delete-maintenance-occurrence/{id}',[
        'as'=>'delete-maintenance-occurrence',
        'uses'=>'MaintenanceOccurrenceController@destroy'
    ]);
    /*Maintenance Occurrence Section End*/

    /*-----------Print Pdf--------------*/

    Route::any('cabin-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'cabin-pdf',
        'uses' => 'CabinCrewController@create_pdf'
    ]);

    Route::any('confidential-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'confidential-pdf',
        'uses' => 'ConfidentialSafetyController@create_pdf'
    ]);

    Route::any('maintenance-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'maintenance-pdf',
        'uses' => 'MaintenanceOccurrenceController@create_pdf'
    ]);

    Route::any('ground-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'ground-pdf',
        'uses' => 'GroundHandlingController@create_pdf'
    ]);

    Route::any('dangerous-pdf/{id}', [
        //'middleware' => 'acl_access:view-role/{slug}',
        'as' => 'dangerous-pdf',
        'uses' => 'OperationalSafetyController@create_pdf'
    ]);


});
