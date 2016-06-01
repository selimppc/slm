<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/4/16
 * Time: 10:48 AM
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;


class PdfManagerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules()
    {
        return [
            /*'file_name' => 'required|max:64'*/

        ];
    }

}