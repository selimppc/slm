<?php


namespace App\Modules\Slm\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;


class Safety extends Model
{

    protected $table = 'air_safety';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name','email','year','telephone','extension','fax','others','captain','pf_pnf','co_pilot','pf_pnf2','date',
        'time','utc_local','air_craft_time','registration','flight_no','from','to','position','altitude','speed','actual_weight',
        'remaining_fuel','atl_ref','delay','diversion','nr_crew','nr_pax','flight_phase','description_of_occurence','imc_vmc','vmc_km','wind_direction',
        'wind_speed','visibility','ceiling','clouds','temperature','qnh','weather_condition','runway','runway_condition','rvr','auto_pilot',
        'auto_thrust','gear','flap','slat','spoilers','type_of_alert','type_of_ra','ra_followed','level_of_risk','evasive_actions','reported_to_atc','atc_instruction',
        'used_frequency','heading','heading_other_ac','ver_seperation','hor_seperation','type_of_bird','nr_of_birds','size','areas_affected','advice_earlier','lighting_conditions',
        'conditions_of_the_sky','course_ac','glidslope_position','pos_extended_center','change_in_pitch','speed_buffet','stickshaker','suspected_wake_turbulance',
        'sign_verticle_accelaration','details_ac_wake_turbulance','advice_other_aircraft','persion_involved','function_position',
        'type_of_influence','comments','status','reference_no','attachment',
    ];



    public function relSaftyImage(){
        return $this->hasMany('App\Modules\Slm\Models\SafetyImage', 'air_safety_id');
    }


}