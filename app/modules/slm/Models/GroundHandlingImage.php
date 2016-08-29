<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/17/16
 * Time: 5:15 PM
 */

namespace App\Modules\Slm\Models;

use Illuminate\Database\Eloquent\Model;


class GroundHandlingImage extends Model
{
    protected $table = 'ground_handling_image';

    protected $fillable = [
        'ground_handling_id','image_path',
    ];

}