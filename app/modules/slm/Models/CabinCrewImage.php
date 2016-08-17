<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/17/16
 * Time: 3:35 PM
 */

namespace App\Modules\Slm\Models;

use Illuminate\Database\Eloquent\Model;


class CabinCrewImage extends Model
{

    protected $table = 'cabin_crew_image';

    protected $fillable = [
        'cabin_crew_id','image_path',
    ];

}