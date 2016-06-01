<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/11/16
 * Time: 1:53 PM
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


class MaintenanceOccurrence extends Model
{
    protected $table='maintenance_occurrence';
    protected $fillable=[
        'full_name',
        'email',
        'telephone',
        'extension',
        'fax',
        'date_of_occurrence',
        'time_of_occurrence',
        'shift',
        'location_of_occurrence',
        'sub_location_of_occurrence',
        'mandatory',
        'aircraft_type',
        'registration',
        'operator',
        'etops',
        'technical_log_ref',
        'tag_or_demand_no',
        'component',
        'part_number',
        'serial_number',
        'quarantined',
        'ata_code',
        'ata_sub_code',
        'title_of_occurrence',
        'description_of_occurrence',
        'created_by',
        'updated_by'
    ];

}