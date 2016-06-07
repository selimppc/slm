<?php

/**
 * Created by PhpStorm.
 * User: shajjad
 * Date: 4/29/2016
 * Time: 12:06 AM
 */
namespace App\Http\Requests;
use App\Http\Requests\Request;


class SafetyRequest extends Request
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
            'full_name' => 'required|max:64'

        ];
    }

    /*public function rules()
    {*/

        //$id = Request::input('id')?Request::input('id'):'';

//print_r($id);exit;

        /*if($id == null)
        {

            return [
                'email'   => 'required|unique:user,email,' . $id,
                'username'   => 'required|unique:user,username,' . $id
            ];

        }else{
            return [


            ];

        }*/


   // }

}