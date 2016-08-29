<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 3/23/16
 * Time: 10:28 AM
 */

namespace App\Modules\Admin\Controllers;


use App\Helpers\Lichtbakken;
use App\Http\Controllers\Controller;
#use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Helpers\ChannelLetter;

class BordController extends Controller
{
    public function bord_index(){

        $pageTitle = '';
        return view('admin::bord.index',['pageTitle'=>$pageTitle]);
    }



    public function channel(){

        $pageTitle = '3D Channel Letters';
        $inst_list = \Bord::getInsList();

        return view('admin::bord.channel',['pageTitle'=>$pageTitle,'inst_list'=>$inst_list]);
    }

    public function store_channel(Request $request){

        $input = $request->all();

        $tekst = $input['tekst'];
        $letter_hoogte = $input['letter_hoogte'];
        $lengte_tekst = $input['lengte_tekst'];
        $model = $input['model'];

        $request_model = $request->get ('model');

        //print_r($request->get ('model'));exit;

        if(isset($input['myCheck'])) {
            $check_value = ($request->get ('myCheck')== "true")? '1' : '0';
            $installment_param['locatie'] = $input['location'];
            $installment_param['achtergrond'] = $input['background'];
            $installment_param['werkhoogte'] = $input['workheight'];
            $installment_param['bracket'] = $input['bracket'];
        }else{
            $installment_param = null;
            $check_value = null;
        }

        $data = ChannelLetter::calculation_3d($tekst, $letter_hoogte, $lengte_tekst, $model, $installment_param);
        $inst_list = \Bord::getInsList();

        return view('admin::bord.channel',['data'=>$data, 'inst_list' => $inst_list,'check_value'=>$check_value,'request_model'=>$request_model]);

    }

    public function achtergrond(){
        $pageTitle = 'Achtergrond Bord';
        return view('admin::bord.achter',['pageTitle'=>$pageTitle]);
    }

    public function lichtbakken(){

        $pageTitle = 'Lichtbakken';
        $inst_list = \Bord::getInsList();

        return view('admin::bord.licht',['pageTitle'=>$pageTitle,'inst_list'=>$inst_list]);
    }

    public function store_lichtbakken(Request $request){
        //exit('jgj');
        $input = $request->all();

        $materiaal_input = $input['materiaal'];
        $enkel_bubbel_input = $input['enkel_dubble'];
        $lengte = $input['lengte'];
        $breedte = $input['breedte'];
        $model = $input['model'];

        $request_model = $request->get ('model');

        if(isset($input['myCheck'])) {
            $check_value = ($request->get ('myCheck')== "true")? '1' : '0';
            $installment_param['locatie'] = $input['location'];
            $installment_param['achtergrond'] = $input['background'];
            $installment_param['werkhoogte'] = $input['workheight'];
            $installment_param['bracket'] = $input['bracket'];
        }else{
            $installment_param = null;
            $check_value = null;
        }

        $data = Lichtbakken::calculation_lichtbakken($materiaal_input,$enkel_bubbel_input,$lengte,$breedte,$model, $installment_param);

        //print_r($data);exit;
        $inst_list = \Bord::getInsList();

        return view('admin::bord.licht',['data'=>$data, 'inst_list' => $inst_list, 'check_value'=>$check_value,'request_model'=>$request_model]);

    }
}