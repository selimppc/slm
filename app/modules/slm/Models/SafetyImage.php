<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/16/16
 * Time: 1:28 PM
 */

namespace App\Modules\Slm\Models;

use Illuminate\Database\Eloquent\Model;


class SafetyImage extends Model
{

    protected $table = 'air_safety_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'air_safety_id','image_path',
    ];
}