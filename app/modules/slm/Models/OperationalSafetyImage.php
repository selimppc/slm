<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/17/16
 * Time: 4:50 PM
 */

namespace App\Modules\Slm\Models;

use Illuminate\Database\Eloquent\Model;


class OperationalSafetyImage extends Model
{

    protected $table = 'operational_safety_image';

    protected $fillable = [
        'operational_safety_id','image_path',
    ];

}