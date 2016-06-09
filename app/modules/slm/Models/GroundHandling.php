<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 4:46 PM
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

class GroundHandling extends Model
{
    protected $table='ground_handling';
    protected $fillable=[
        'full_name',
        'email',
        'telephone',
        'extension',
        'fax',
        'location_of_occurrence',
        'ramp_condition',
        'operational_phase',
        'date',
        'time',
        'utc_local',
        'operator',
        'flight_number',
        'aircraft_type',
        'registration',
        'from',
        'to',
        'delay',
        'diversion',
        'third_party_involved',
        'description_of_occurrence',
        'origin_of_the_goods',
        'iata_un_or_id',
        'class_or_division',
        'subsidiary_risk',
        'packing_group',
        'class_7_category',
        'type_of_packing',
        'packing_spec_marking',
        'number_of_packages',
        'quantity_of_transport_index',
        'airway_bill_reference',
        'courier_pouch_reference',
        'shipping_agent',
        'shipping_name',
        'damage_to',
        'damage_by',
        'area',
        'enviromental_condition',
        'details_of_damage',
        'attachment',
        'created_by',
        'updated_by'
    ];
}