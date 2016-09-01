<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 2:16 PM
 */
namespace App\Modules\Slm\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;


class OperationalSafety extends Model
{
    protected $table='operational_safety';
    protected $fillable=[
        'type_of_occurrence',
        'operator',
        'date_of_occurrence',
        'local_time_of_occurrence',
        'flight_date',
        'flight_no',
        'departure_airport',
        'destination_airport',
        'aircraft_type',
        'aircraft_registration',
        'location_of_occurrence',
        'origin_of_the_goods',
        'description_of_the_occurrence',
        'subsidiary_risks',
        'proper_shipping_name',
        'un_or_id_no',
        'class_or_division',
        'packing_group',
        'category',
        'type_of_packaging',
        'packaging_specification_marking',
        'no_of_packages',
        'quantity',
        'reference_no_of_airway_bill',
        'reference_no_of_courier',
        'name_and_address_of_shipper_agent_passenger',
        'other_relevant_information',
        'name_and_title_of_person_making_report',
        'telephone_no',
        'company_contact',
        'reporter_ref',
        'address',
        'signature',
        'date_of_signature',
        'attachment',
        'created_by',
        'updated_by',
    ];

}