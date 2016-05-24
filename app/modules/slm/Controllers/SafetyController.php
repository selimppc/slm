<?php

namespace App\Modules\Slm\Controllers;

use App\Helpers\LogFileHelper;
use App\Modules\Slm\Models\Safety;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Auth;

use Dompdf\Dompdf;


class SafetyController extends Controller
{
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function air_safety_info(){

        $pageTitle = 'Air Safety Informations';
        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data = Safety::where('status','!=','cancel')->where('full_name', 'LIKE', '%'.$full_name.'%')->paginate(30);
        //$data = Safety::get();
       //print_r($data);exit;

        return view('slm::air_safety.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }

    public function safety_add_info(){

        $pageTitle = 'Air Safety Add Informations';

        return view('slm::air_safety._form',['pageTitle'=>$pageTitle]);
    }

    public function store_safety(Requests\SafetyRequest $request)
    {
        $input = $request->all();
        $model = new Safety();

        $input['date']=date("Y-m-d", strtotime($input['date']));

        //print_r($input['date']);exit;

        $model->full_name = @$input['full_name'];$model->email = @$input['email'];
        $model->telephone = @$input['telephone'];$model->extension = @$input['extension'];$model->fax = @$input['fax'];
        $model->others = @$input['others'];$model->captain = @$input['captain'];$model->pf_pnf = @$input['pf_pnf'];
        $model->co_pilot = @$input['co_pilot'];$model->pf_pnf2 = @$input['pf_pnf2'];$model->date = @$input['date'];
        $model->time = @$input['time'];$model->utc_local = @$input['utc_local'];$model->air_craft_time = @$input['air_craft_time'];
        $model->registration = @$input['registration'];$model->flight_no = @$input['flight_no'];$model->from = @$input['from'];
        $model->to = @$input['to'];$model->position = @$input['position'];$model->altitude = @$input['altitude'];
        $model->speed = @$input['speed'];$model->actual_weight = @$input['actual_weight'];$model->remaining_fuel = @$input['remaining_fuel'];
        $model->atl_ref = @$input['atl_ref'];$model->delay = @$input['delay'];$model->diversion = @$input['diversion'];
        $model->nr_crew = @$input['nr_crew'];$model->nr_pax = @$input['nr_pax'];$model->flight_phase = @$input['flight_phase'];
        $model->description_of_occurence = @$input['description_of_occurence'];$model->imc_vmc = @$input['imc_vmc'];
        $model->vmc_km = @$input['vmc_km'];$model->wind_direction = @$input['wind_direction'];$model->wind_speed = @$input['wind_speed'];
        $model->visibility = @$input['visibility'];$model->ceiling = @$input['ceiling'];$model->clouds = @$input['clouds'];
        $model->temperature = @$input['temperature'];$model->qnh = @$input['qnh'];$model->weather_condition = @$input['weather_condition'];
        $model->runway = @$input['runway'];$model->runway_condition = @$input['runway_condition'];$model->rvr = @$input['rvr'];
        $model->auto_pilot = @$input['auto_pilot'];$model->auto_thrust = @$input['auto_thrust'];$model->gear = @$input['gear'];
        $model->flap = @$input['flap'];$model->slat = @$input['slat'];$model->spoilers = @$input['spoilers'];
        $model->type_of_alert = @$input['type_of_alert'];$model->type_of_ra = @$input['type_of_ra'];$model->ra_followed = @$input['ra_followed'];
        $model->level_of_risk = @$input['level_of_risk'];$model->evasive_actions = @$input['evasive_actions'];
        $model->reported_to_atc = @$input['reported_to_atc'];$model->atc_instruction = @$input['atc_instruction'];
        $model->used_frequency = @$input['used_frequency'];$model->heading = @$input['heading'];$model->heading_other_ac = @$input['heading_other_ac'];
        $model->ver_seperation = @$input['ver_seperation'];$model->hor_seperation = @$input['hor_seperation'];
        $model->type_of_bird = @$input['type_of_bird'];$model->nr_of_birds = @$input['nr_of_birds'];
        $model->size = @$input['size'];$model->areas_affected = @$input['areas_affected'];
        $model->advice_earlier = @$input['advice_earlier'];$model->lighting_conditions = @$input['lighting_conditions'];
        $model->conditions_of_the_sky = @$input['conditions_of_the_sky'];$model->course_ac = @$input['course_ac'];
        $model->glidslope_position = @$input['glidslope_position'];$model->pos_extended_center = @$input['pos_extended_center'];
        $model->change_in_pitch = @$input['change_in_pitch'];$model->speed_buffet = @$input['speed_buffet'];
        $model->stickshaker = @$input['stickshaker'];$model->suspected_wake_turbulance = @$input['suspected_wake_turbulance'];
        $model->sign_verticle_accelaration = @$input['sign_verticle_accelaration'];
        $model->details_ac_wake_turbulance = @$input['details_ac_wake_turbulance'];
        $model->advice_other_aircraft = @$input['advice_other_aircraft'];$model->persion_involved = @$input['persion_involved'];
        $model->function_position = @$input['function_position'];$model->type_of_influence = @$input['type_of_influence'];
        $model->comments = @$input['comments'];$model->status = @$input['status'];

        //$input['slug'] = str_slug(strtolower($input['title']));

        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
        //print_r($user);exit;


        if($model->save()) {

            try{
                Mail::send('slm::air_safety.mail_notification', array('model'=>$model),
                    function($message) use ($user)
                    {
                        $message->from('devdhaka405@gmail.com', 'New Air Safety Data Added');
                        //$message->from('tanintjt.1990@gmail.com', 'AFFIFACT');
                        $message->to($user->email);
                        //$message->to('shajjadhossain81@gmail.com');
                        //$message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Air Safety Data Added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Air safety has been successfully stored.');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Does not Save!');
        }

        /* Transaction Start Here */
        /*DB::beginTransaction();
        try {
            Safety::create($input);
            DB::commit();
            Session::flash('message', 'Successfully added!');
            //LogFileHelper::log_info('store-role', 'Successfully added', ['Role title: '.$input['title']]);
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            //LogFileHelper::log_error('store-role', $e->getMessage(), ['Role title: '.$input['title']]);
        }*/

        return redirect()->route('air-safety');
    }


    public function show($id)
    {
        $pageTitle = 'View Safety Informations';
        $data = Safety::where('id',$id)->first();

        return view('slm::air_safety.view', ['data' => $data, 'pageTitle'=> $pageTitle]);
    }

    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = Safety::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."AirSafety.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'NAME','EMAIL', 'TELEPHONE', 'EXTENSION','FAX','CAPTAIN','PF/PNF','CO-PILOT','PF/PNF','OTHER','DATE','TIME','UTC/LOCAL','AIRCRAFT TYPE','REGISTRATION','FLIGHT NUMBER','FROM','TO','POSITION','ALTITUDE','SPEED/MACH','ACTUAL WEIGHT','REMAINING FUEL','ATL REF','DELAY (min)','DIVERSION','NR CREW','NR. PAX','FLIGHT PHASE','DESCRIPTION OF OCCURRENCE','IMC/VMC','VCM (km)','WIND DIRECTION (deg)','WIND SPEED','VISIBILITY','CEILING','CLOUDS','TEMPERATURE','QNH','WEATHER CONDITION','RUNWAY','RUNWAY CONDITION','RVR (M)','AUTO PILOT','AUTO THRUST','GEAR','FLAP','SLAT','SPOILERS','TYPE OF ALERT','TYPE OF RA','RA FOLLOWED','LEVEL OF RISK','EVASIVE ACTIONS','REPORTED TO ATC','ATC INSTUCTIONS','USED FREQUENCY','HEADING','HEADING OF THE OTHER AC','VER. SEPARATION','HOR. SEPARATION','TYPE OF BIRD','NR of BIRDS','SIZE','AREAS AFFECTED','ADVISED EARLIER','LIGHTING CONDITIONS','CODITION OF THE SKY','Course of the AC','GLIDSLOPE POSITION','POS. ON EXTENDED CENTR. LINE','CHANGE IN PITCH (deg)','CHANGE IN ROLL (deg)','CHANGE IN YAW (deg)','CHANGE IN ALT','SPEED BUFFET?','STICKSHAKER?','SUSPECTED WAKE TURBULANCE','SIGN. VERTICAL ACCELARATION','DETAILS OF AC WAKE TURBULANCE?','ADVISE TO OTHER AIRCRAFT','PERSON INVOLVED (name)','FUNCTION/POSITION','TYPE OF INFLUENCE','COMMENTS'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {

            fputcsv($handle, array($row['full_name'], $row['email'], $row['telephone'], $row['extension'], $row['fax'], $row['captain'],$row['pf_pnf'], $row['co_pilot'],$row['pf_pnf2'], $row['others'], $row['date'], $row['time'],$row['utc_local'],$row['air_craft_time'], $row['registration'], $row['flight_no'], $row['from'], $row['to'], $row['position'], $row['altitude'], $row['speed'], $row['actual_weight'], $row['remaining_fuel'], $row['atl_ref'], $row['delay'], $row['diversion'], $row['nr_crew'], $row['nr_pax'], $row['flight_phase'],$row['description_of_occurence'],$row['imc_vmc'],$row['vmc_km'],$row['wind_direction'],$row['wind_speed'],$row['visibility'],$row['ceiling'],$row['clouds'],$row['temperature'],$row['qnh'],$row['weather_condition'],$row['runway'],$row['runway_condition'],$row['rvr'],$row['auto_pilot'],$row['auto_thrust'],$row['gear'],$row['flap'],$row['slat'],$row['spoilers'],$row['type_of_alert'],$row['type_of_ra'],$row['ra_followed'],$row['level_of_risk'],$row['evasive_actions'],$row['reported_to_atc'],$row['atc_instruction'],$row['used_frequency'],$row['heading'],$row['heading_other_ac'],$row['ver_seperation'],$row['hor_seperation'],$row['type_of_bird'],$row['nr_of_birds'],$row['size'],$row['areas_affected'],$row['advice_earlier'],$row['lighting_conditions'],$row['conditions_of_the_sky'],$row['course_ac'],$row['glidslope_position'],$row['pos_extended_center'],$row['change_in_pitch'],$row['change_in_roll'],$row['change_in_yaw'],$row['change_in_alt'],$row['speed_buffet'],$row['stickshaker'],$row['suspected_wake_turbulance'],$row['sign_verticle_accelaration'],$row['details_ac_wake_turbulance'],$row['advice_other_aircraft'],$row['persion_involved'],$row['function_position'],$row['type_of_influence'],$row['comments']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'AirSafety.csv', $headers);
    }


    public function edit($id)
    {
        $pageTitle = "Update Air Safety Informations";
        $data = Safety::where('id',$id)->first();

        $data['date']=date("M d, Y", strtotime($data['date']));

        //print_r($data['date']);exit;
        return view('slm::air_safety.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        //$input['slug'] = str_slug(strtolower($input['title']));

        $input['date']=date("Y-m-d", strtotime($input['date']));

        $model = Safety::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $model->update($input);
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
            //LogFileHelper::log_info('update-role', 'Successfully updated.', ['Role title: '.$input['title']]);
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            //LogFileHelper::log_error('update-role', $e->getMessage(), ['Role title: '.$input['title']]);
        }
        //}
        return redirect()->route('air-safety');
    }

    public function destroy($id)
    {
        /*$model = Safety::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $model->status = 'cancel';
            $model->save();
            DB::commit();
            Session::flash('message', "Successfully Deleted.");
            //LogFileHelper::log_info('delete-role', 'Successfully status cancel', ['Role title: '.$model->title]);

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
            //LogFileHelper::log_error('delete-role', $e->getMessage(), ['Role title: '.$model->title]);
        }
        return redirect()->route('air-safety');*/

        DB::beginTransaction();
        try {
            $model = Safety::where('id',$id)->first();
            if ($model->delete()) {
                DB::commit();
                Session::flash('message', 'Successfully deleted!');
                return redirect()->back();
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }
        return redirect()->route('air-safety');
    }

    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $data=Safety::findOrFail($id);

        $image_path = public_path().'/assets/img/report.jpg';
        $image_path2 = public_path().'/assets/img/report_black.jpg';
        $img = '<img src="'.$image_path.'" height="150" width="300"  alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'" height="150" width="300"  alt="Surinam Airways" >';

        if($cabin_crew->pf_pnf == 'pf'){$pf='checked';}else{$pf='';}
        if($cabin_crew->pf_pnf == 'pnf'){$pnf='checked';}else{$pnf='';}

        if($cabin_crew->pf_pnf2 == 'pf'){$pf2='checked';}else{$pf2='';}
        if($cabin_crew->pf_pnf2 == 'pnf'){$pnf2='checked';}else{$pnf2='';}

        if($cabin_crew->utc_local== 'utc'){$checked_utc='checked';}else{$checked_utc='';}
        if($cabin_crew->utc_local== 'local'){$checked_local='checked';}else{$checked_local='';}

        if($cabin_crew->flight_phase== 'parked'){$fp1='checked';}else{$fp1='';}
        if($cabin_crew->flight_phase== 'push_back'){$fp2='checked';}else{$fp2='';}
        if($cabin_crew->flight_phase== 'taxi_out'){$fp3='checked';}else{$fp3='';}
        if($cabin_crew->flight_phase== 'take_off'){$fp4='checked';}else{$fp4='';}
        if($cabin_crew->flight_phase== 'initial_climb'){$fp5='checked';}else{$fp5='';}
        if($cabin_crew->flight_phase== 'climb'){$fp6='checked';}else{$fp6='';}
        if($cabin_crew->flight_phase== 'cruise'){$fp7='checked';}else{$fp7='';}
        if($cabin_crew->flight_phase== 'holding'){$fp8='checked';}else{$fp8='';}
        if($cabin_crew->flight_phase== 'descent'){$fp9='checked';}else{$fp9='';}
        if($cabin_crew->flight_phase== 'approach'){$fp10='checked';}else{$fp10='';}
        if($cabin_crew->flight_phase== 'landing'){$fp11='checked';}else{$fp11='';}
        if($cabin_crew->flight_phase== 'taxi_in'){$fp12='checked';}else{$fp12='';}

        $html = '

<style>
    .tbl {
        margin: 0px !important;
        border: 2px solid;
        border-bottom: 0px!important;
        width: 100%;
    }

    .tbl3 {
        margin: 0px !important;
        border: 2px solid;
        border-top: 0px!important;
        border-left: 0px!important;
        border-right: 0px!important;
        width: 100%;
    }

    .tbl2 {
       margin: 0px !important;
       border: 2px solid;
       width: 100%;
    }
    .tbl2 tr th {
        border: 2px solid;
    }

    .tbl2 th{
    text-align: left;
    }

    .tbl2 tr td {
        padding:7px; text-align: left;
        text-align: left !important;
        }

    .report_img{
        height: 100px!important;
        text-align: center!important;
        padding: 15px 10px 18px 10px!important;
    }

    .report_img2{
        height: 10px!important;
        text-align: left!important;
        padding: 5px 2px 8px 2px!important;
    }

    .panel, .panel-body{
        width: 100%;
    }


</style>

    <div class="panel">
        <div class="panel-body">
            <div class="panel-body">
            <table cellspacing="0" cellpadding="0" class="table table-bordered table-responsive tbl3">
                <tr>
                    <th width="50%" class="report_img2">
                        '.$img2.'
                        <br><span style="font-weight: bolder; font-size:20px;">SAFETY MANAGEMENT MANUAL</span>
                    </th>
                    <th style="border-left: 2px solid" width="50%">
                        <p style="font-weight: bolder; font-size:20px;" align="left">5              APPENDICES</p>
                        <p style="font-weight: bolder; font-size:20px;" align="left">B Operational Safety Report (OSR)</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">B. OPERATIONAL SAFETY REPORT</span>
            </table>
            <br>
            <br>
            <br>

            <table cellspacing="0" cellpadding="0" class="table table-bordered table-responsive tbl">
                <tr>
                    <th rowspan="2" style="border-right: 2px solid" width="33%" class="report_img">
                        '.$img.'</th>
                    <th rowspan="2" style="border-right: 2px solid" width="33%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">OSR</p>
                        <p style="height: 25px"; align="center"><font size="+2";><u>Operational Safety</u></font></p>
                        <p style="height: 25px" align="center"><font size="+2";><u>Report</u></font></p>
                    </th>
                    <th style="border-bottom: 2px solid; font-size: 20px; text-align: center;">Safety Department ref. nr:</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">AIR SAFETY REPORT</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-bordered table-responsive no-spacing tbl2">
                <tr>
                    <th style="text-align: center; background-color: yellow" colspan="6">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : '.$data->full_name.','.$data->email.','.$data->telephone.','.$data->extension.','.$data->fax.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="32%" style="border: 2px solid" colspan="2">
                        2. CAPTAIN : '.$data->captain.'&nbsp;&nbsp;
                        <input type="checkbox" name="pf_pnf" value=""  '.$pf.' style="display:inline;" > PF
                        <input type="checkbox" name="pf_pnf" value="" '.$pnf.' style="display:inline;" >  PNF
                    </th>
                    <th width="32%" style="border: 2px solid" colspan="2">
                        3. CO-PILOT : '.$data->co_pilot.' &nbsp;&nbsp;
                        <input type="checkbox" name="pf_pnf2" value=""  '.$pf2.' style="display:inline;" > PF
                        <input type="checkbox" name="pf_pnf2" value="" '.$pnf2.' style="display:inline;" >  PNF

                        </th>
                    <th width="36%" style="border: 2px solid" colspan="2">4. OTHER : '.$data->others.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">5. DATE : '.date("M d, Y", strtotime($data->date)).'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">
                        6. TIME : '.$data->time.' &nbsp;&nbsp;
                        <input type="checkbox" name="utc_local" value=""  '.$checked_utc.' style="display:inline;" > UTC
                        <input type="checkbox" name="utc_local" value="" '.$checked_local.' style="display:inline;" >  Local
                    </th>
                    <th width="16%" style="border: 2px solid">7. AIRCRAFT TYPE : '.$data->air_craft_time.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">8. REGISTRATION : '.$data->registration.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">9. FLIGHT NUMBER : '.$data->flight_no.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">10. FROM : '.$data->from.'</th>
                    <th width="16%" style="border: 2px solid">11. TO : '.$data->to.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">12. POSITION (geogr. Co-ord) : '.$data->position.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">13. ALTITUDE : '.$data->altitude.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">14. SPEED/MACH : '.$data->speed.'</th>
                    <th width="16%" style="border: 2px solid">15. ACTUAL WEIGHT : '.$data->actual_weight.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">16. REMAINING FUEL : '.$data->remaining_fuel.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">17. ATL REF. : '.$data->atl_ref.'</th>
                    <th width="32%" style="border: 2px solid">18. DELAY (min) : '.$data->delay.'</th>
                    <th width="16%" style="border: 2px solid">19. DIVERSION : '.$data->diversion.'</th>
                    <th width="16%" style="border: 2px solid">20. NR CREW : '.$data->nr_crew.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">21. NR. PAX : '.$data->nr_pax.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        22. FLIGHT PHASE : '.$data->flight_phase.'
                        <br>
                    <input type="checkbox" name="flight_phase" value=""  '.$fp1.' style="display:inline;" > PARKED &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp2.' style="display:inline;" > PUSH BACK&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp3.' style="display:inline;" > TAXI OUT&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp4.' style="display:inline;" > TAKE OFF&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp5.' style="display:inline;" > INITIAL CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp6.' style="display:inline;" > CLIMB&nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    <input type="checkbox" name="flight_phase" value=""  '.$fp7.' style="display:inline;" > CRUISE &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp8.' style="display:inline;" > HOLDING&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp9.' style="display:inline;" > DESCENT&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp10.' style="display:inline;" > APPROACH&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp11.' style="display:inline;" > LANDING&nbsp;&nbsp;
                    <input type="checkbox" name="flight_phase" value=""  '.$fp12.' style="display:inline;" > TAXI IN
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        23. DESCRIPTION OF OCCURRENCE ( add forms if necessary) :
                        <p>'.$data->description_of_occurence.'</p>
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">METEOROLOGICAL INFORMATION</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">24. IMC/VMC : '.$data->imc_vmc.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">25. VCM (km) : '.$data->vmc_km.'</th>
                    <th width="16%" style="border: 2px solid">26. WIND DIRECTION (deg) : '.$data->wind_direction.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">
                        27. WIND SPEED : '.$data->wind_speed.'
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">28. VISIBILITY : '.$data->visibility.'</th>
                    <th width="32%" style="border: 2px solid">29. CEILING : '.$data->ceiling.'</th>
                    <th width="16%" style="border: 2px solid">30. CLOUDS : '.$data->clouds.'</th>
                    <th width="16%" style="border: 2px solid">31. TEMPERATURE : '.$data->temperature.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">32. QNH : '.$data->qnh.'</th>
                </tr>

                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        33. WEATHER CONDITION : '.$data->weather_condition.'
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">34. RUNWAY : '.$data->runway.'</th>
                    <th width="48%" style="border: 2px solid" colspan="4">35. RUNWAY CONDITION : '.$data->runway_condition.'</th>
                    <th width="20%" style="border: 2px solid">36. RVR (M) : '.$data->rvr.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid">37. AUTO PILOT : '.$data->auto_pilot.'</th>
                    <th width="32%" style="border: 2px solid">38. AUTO THRUST : '.$data->auto_thrust.'</th>
                    <th width="16%" style="border: 2px solid">
                        39. GEAR :'.$data->gear.'

                    </th>
                    <th width="16%" style="border: 2px solid">40. FLAP : '.$data->flap.'</th>
                    <th width="36%" style="border: 2px solid">41. SLAT : '.$data->slat.'</th>
                    <th width="36%" style="border: 2px solid">42. SPOILERS : '.$data->spoilers.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">TCAS INFORMATION (traffic)</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        43. TYPE OF ALERT : '.$data->type_of_alert.'
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">44. TYPE OF RA : '.$data->type_of_ra.'</th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        45. RA FOLLOWED? : '.$data->ra_followed.'
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">ATC PROCEDURES</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        46. LEVEL OF RISK : '.$data->level_of_risk.'
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">
                        47. EVASIVE ACTIONS : '.$data->evasive_actions.'
                    </th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        48. REPORTED TO ATC? : '.$data->reported_to_atc.'
                    </th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        49. ATC INSTUCTIONS : '.$data->atc_instruction.'
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">
                        50. USED FREQUENCY :
                        '.$data->used_frequency.'
                    </th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        51. HEADING :
                        '.$data->heading.'
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">
                        52. HEADING OF THE OTHER AC :
                        '.$data->heading_other_ac.'
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">AIRPROX</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        53. VER. SEPARATION :
                        '.$data->ver_seperation.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        54. HOR. SEPARATION :
                        '.$data->hor_seperation.'
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        55. TYPE OF BIRD :
                        '.$data->type_of_bird.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        56. nr of BIRDS : '.$data->nr_of_birds.'
                    </th>
                    <th width="52%" style="border: 2px solid">
                        57. SIZE :
                        '.$data->size.'
                    </th>
                    <th width="52%" style="border: 2px solid">
                        58. AREAS AFFECTED :
                        '.$data->areas_affected.'
                    </th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        59. ADVISED EARLIER? : '.$data->advice_earlier.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        60. LIGHTING CONDITIONS :
                        '.$data->lighting_conditions.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        61. CODITION OF THE SKY : '.$data->conditions_of_the_sky.'
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">BIRD STRIKE</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        62. Course of the AC : '.$data->course_ac.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        63. GLIDSLOPE POSITION : '.$data->glidslope_position.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        64. POS. ON EXTENDED CENTR. LINE. : '.$data->pos_extended_center.'
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        65. CHANGE IN PITCH (deg) :'.$data->change_in_pitch.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        66. CHANGE IN ROLL (deg) :'.$data->change_in_roll.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        67. CHANGE IN YAW (deg) :'.$data->change_in_yaw.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        68. CHANGE IN ALT. :'.$data->change_in_alt.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        69. SPEED BUFFET? :'.$data->speed_buffet.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        70. STICKSHAKER? :'.$data->stickshaker.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        71. SUSPECTED WAKE TURBULANCE :'.$data->suspected_wake_turbulance.'</th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        72. SIGN. VERTICAL ACCELARATION :'.$data->sign_verticle_accelaration.'</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        73. DETAILS OF AC WAKE TURBULANCE? :'.$data->details_ac_wake_turbulance.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        74. ADVISE TO OTHER AIRCRAFT :'.$data->advice_other_aircraft.'</th>

                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; background-color: yellow" colspan="6">HUMAN FACTORS</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        75. PERSON INVOLVED (name) [ optional field] :'.$data->persion_involved.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        76. FUNCTION/POSITION :'.$data->function_position.'</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="6">
                        77. TYPE OF INFLUENCE :'.$data->type_of_influence.'</th>

                </tr>
                <tr style="border: 2px solid">
                    <th width="48%" style="border: 2px solid" colspan="6">
                        78. COMMENTS :'.$data->comments.'</th>

                </tr>




                <tr>
                    <th colspan="6">Please sent this information to the Safety Department at your earliest convenience but no later than 24 hours after the occurrence, via fax +597 430230 or via e-mail : safety@slm.firm.sr</th>
                </tr>
                <tr>
                    <th colspan="6">This form can also be submitted via the company website: www.flyslm.com
You may report anonymously</th>
                </tr>
            </table>
        </div>

    </div>';

        //$html = CabinCrewController::show(1);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream();
    }



}