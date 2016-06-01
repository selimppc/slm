<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/9/16
 * Time: 10:37 AM
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

class CabinCrew extends Model
{
    protected $table = 'cabin_crew';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'telephone',
        'extension',
        'fax',
        'others',
        'captain',
        'pf_pnf',
        'co_pilot',
        'pf_pnf2',
        'date',
        'time',
        'utc_local',
        'air_craft_type',
        'registration',
        'flight_no',
        'from',
        'to',
        'flt_diverted_to',
        'assigned_door',
        'position_during_event',
        'nr_of_pax',
        'nr_of_crew',
        'previous_flights',
        'nr_of_landings_of_the_day',
        'flight_phase',
        'description_of_occurrence'
    ];
}