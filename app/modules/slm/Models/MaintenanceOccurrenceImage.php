<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/17/16
 * Time: 5:39 PM
 */

namespace App\Modules\Slm\Models;

use Illuminate\Database\Eloquent\Model;


class MaintenanceOccurrenceImage extends Model
{

    protected $table = 'maintenance_occurrence_image';

    protected $fillable = [
        'maintenance_occurrence_id','image_path',
    ];

}