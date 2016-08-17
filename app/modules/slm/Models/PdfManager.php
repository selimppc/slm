<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/4/16
 * Time: 10:28 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;



class PdfManager extends Model
{
    protected $table = 'document';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name',
        'year',
        'file_type',
        'file_size',
        'pdf_type',
    ];
}