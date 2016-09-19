<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/19/16
 * Time: 1:00 PM
 */

namespace App\Modules\Slm\Models;
use Illuminate\Database\Eloquent\Model;


class ConfidentSafetyImage extends Model
{

    protected $table = 'confident_safety_image';

    protected $fillable = [
        'confident_safety_id','image_path',
    ];
}