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

class ConfidentSafety extends Model
{
    protected $table = 'confident_safety';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'email',
        'telephone',
        'function',
        'department',
        'aircraft_involved',
        'type_of_operation',
        'weather',
        'flight_phase',
        'account_of_event'
    ];

    public function relConfidentSafety(){
        return $this->hasMany('App\Modules\Slm\Models\ConfidentSafetyImage', 'confident_safety_id');
    }
}