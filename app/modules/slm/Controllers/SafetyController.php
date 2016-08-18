<?php

namespace App\Modules\Slm\Controllers;

use App\Helpers\LogFileHelper;
use App\Modules\Slm\Models\Safety;
use App\Modules\Slm\Models\SafetyImage;
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
use App\Modules\User\Models\UserSignature;

use Validator;

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
        $year = Input::get('year');
        //$data = new Safety();
        $data = Safety::where('status','!=','cancel')->where('full_name', 'LIKE', '%'.$full_name.'%')->where('year', 'LIKE', '%'.$year.'%')->paginate(30);
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

        $model->full_name = @$input['full_name'];
        $model->year = @$input['year'];
        $model->email = @$input['email'];
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
        //$model->status = @$input['reference_no'];

        //$input['slug'] = str_slug(strtolower($input['title']));



        //----------------- For Attachment file-------------------//
        $file_attachments=Input::file('attachment');
        //print_r($file_attachment); exit();
        if(isset($file_attachments)){
            /*$rules = array('file' => 'mimes:pdf,doc');*/
            /*$rules = array('file' => 'max:300');*/

            foreach($file_attachments as $file_attachment) {

                $rules = array();
                $validator = Validator::make(array('file' => $file_attachment), $rules);
                //print_r($validator->passes());exit;

                if ($validator->passes()) {
                    //exit('Exit');
                    $upload_folder = 'attachment/';
                    if (!file_exists($upload_folder)) {
                        $oldmask = umask(0);  // helpful when used in linux server
                        mkdir($upload_folder, 0777);
                    }
                    if(isset($file_attachment)) {
                        $file_original_name = $file_attachment->getClientOriginalName();

                        $file_name = rand(11111, 99999) . '-' . $file_original_name;
                        $file_attachment->move($upload_folder, $file_name);
                        $attachment = $upload_folder . $file_name;
                        //$model->attachment = $attachment;

                        $image_path[] = $attachment;
                    }

                    //print_r($attachment); exit();

                } else {
                    // Redirect or return json to frontend with a helpful message to inform the user
                    // that the provided file was not an adequate type
                    return redirect('add-operational-safety')
                        ->withErrors($validator)
                        ->withInput();
                }
            }
        }//---------End Attachment
        //print_r($image_path); exit();



        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
        //print_r($model);exit;


        if($model->save()) {

            if(isset($image_path)){
                foreach($image_path as $ims){
                    $safety_image[] = [
                        'air_safety_id' => $model->id,
                        'image_path'=>$ims,
                    ];
                }
                foreach($safety_image as $input_image){

                    SafetyImage::create($input_image);
                }
            }

            try{
                Mail::send('slm::air_safety.mail_notification', array('model'=>$model),
                    function($message) use ($user)
                    {
                        $message->from('devdhaka405@gmail.com', 'New Air Safety Data Added');
                        //$message->from('tanintjt.1990@gmail.com', 'AFFIFACT');
                        $message->to($user->email);
                        //$message->to('pothiceee@gmail.com');
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
        $data_image = SafetyImage::where('air_safety_id',$id)->get();

        return view('slm::air_safety.view', ['data' => $data,'data_image' => $data_image, 'pageTitle'=> $pageTitle]);
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
        //$data['safety_verification'] = Safety::where('id',$id)->first();

        //print_r($data->reference_no); exit;

        //print_r($data['safety_verification']); exit();

        //print_r($data['date']);exit;
        return view('slm::air_safety.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        //$input['slug'] = str_slug(strtolower($input['title']));

        $input['date']=date("Y-m-d", strtotime($input['date']));
        //print_r($input); exit();
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

    public function sent_receive_form($id)
    {
        $pageTitle = "Send Receive Form";
        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id',$user_id)->first();
        //$signature = DB::table('user_signature')->where('user_id',$id)->get();
        //print_r($signature); exit();

        return view('slm::air_safety.send_receive', ['data' => $id,'pageTitle'=> $pageTitle,'signature'=>$signature]);
    }
    public function update_send_receive(Request $request, $id)
    {
        $input = $request->all();
        $model = Safety::where('id', $id)->get();

        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id', $user_id)->first();
        //print_r($signature->image); exit();
        //$user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $user = DB::table('air_safety')->where('id', $id)->first();

        $data_signature['image_path'] = $signature->image;
        $data_signature['image_thumb'] = $signature->thumbnail;
        $data_signature['current_date'] = date('M d, Y');
        $data_signature['created_at'] = (date("M d, Y", strtotime($model[0]['created_at'])));
        $data_signature['regards'] = $input['regards'];
        $data_signature['full_name'] = $user->full_name;
        $data_signature['report'] = 'Air Safety Report';

        try {
            Mail::send('slm::air_safety.mail_send_receive', array('ground_handling' => $data_signature),
                function ($message) use ($user) {
                    //$message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                    $message->from('devdhaka405@gmail.com', 'SLM');
                    $message->to($user->email);
                    //$message->to($user->email);
                    //$message->to('selimppc@gmail.com');
                    //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                    $message->subject('New Air Safety added');
                });

            $data2['sent_receive'] = 1;

            Safety::where('id', $id)->update($data2);

            #print_r($user);exit;
            Session::flash('message', 'Air Safety Report has been Sent Successfully');
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return redirect()->previous();
        }
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

        $image_path = public_path().'/assets/img/slm-logo-main.png';
        $image_path2 = public_path().'/assets/img/slm-logo-for-pdf.png';
        $img = '<img src="'.$image_path.'"  alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'"  alt="Surinam Airways" >';

        if($data->pf_pnf == 'pf'){$pf='checked';}else{$pf='';}
        if($data->pf_pnf == 'pnf'){$pnf='checked';}else{$pnf='';}

        if($data->pf_pnf2 == 'pf'){$pf2='checked';}else{$pf2='';}
        if($data->pf_pnf2 == 'pnf'){$pnf2='checked';}else{$pnf2='';}

        if($data->utc_local== 'utc'){$checked_utc='checked';}else{$checked_utc='';}
        if($data->utc_local== 'local'){$checked_local='checked';}else{$checked_local='';}

        if($data->wind_speed== 'km_hr'){$ws1='checked';}else{$ws1='';}
        if($data->wind_speed== 'knoth'){$ws2='checked';}else{$ws2='';}

        if($data->flight_phase== 'parked'){$fp1='checked';}else{$fp1='';}
        if($data->flight_phase== 'push_back'){$fp2='checked';}else{$fp2='';}
        if($data->flight_phase== 'taxi_out'){$fp3='checked';}else{$fp3='';}
        if($data->flight_phase== 'take_off'){$fp4='checked';}else{$fp4='';}
        if($data->flight_phase== 'initial_climb'){$fp5='checked';}else{$fp5='';}
        if($data->flight_phase== 'climb'){$fp6='checked';}else{$fp6='';}
        if($data->flight_phase== 'cruise'){$fp7='checked';}else{$fp7='';}
        if($data->flight_phase== 'holding'){$fp8='checked';}else{$fp8='';}
        if($data->flight_phase== 'descent'){$fp9='checked';}else{$fp9='';}
        if($data->flight_phase== 'approach'){$fp10='checked';}else{$fp10='';}
        if($data->flight_phase== 'landing'){$fp11='checked';}else{$fp11='';}
        if($data->flight_phase== 'taxi_in'){$fp12='checked';}else{$fp12='';}

        if($data->weather_condition== 'soft'){$weather1='checked';}else{$weather1='';}
        if($data->weather_condition== 'moderate'){$weather2='checked';}else{$weather2='';}
        if($data->weather_condition== 'severe'){$weather3='checked';}else{$weather3='';}
        if($data->weather_condition== 'turbulence'){$weather4='checked';}else{$weather4='';}
        if($data->weather_condition== 'wind_shear'){$weather5='checked';}else{$weather5='';}
        if($data->weather_condition== 'rain'){$weather6='checked';}else{$weather6='';}
        if($data->weather_condition== 'hail'){$weather7='checked';}else{$weather7='';}
        if($data->weather_condition== 'mist'){$weather8='checked';}else{$weather8='';}
        if($data->weather_condition== 'fog'){$weather9='checked';}else{$weather9='';}
        if($data->weather_condition== 'snow'){$weather10='checked';}else{$weather10='';}


        if($data->runway_condition== 'dry'){$runway1='checked';}else{$runway1='';}
        if($data->runway_condition== 'wet'){$runway2='checked';}else{$runway2='';}
        if($data->runway_condition== 'mist'){$runway3='checked';}else{$runway3='';}
        if($data->runway_condition== 'snow'){$runway4='checked';}else{$runway4='';}

        if($data->gear== 'up'){$gear1='checked';}else{$gear1='';}
        if($data->gear== 'down'){$gear2='checked';}else{$gear2='';}


        if($data->type_of_alert== 'none'){$alert1='checked';}else{$alert1='';}
        if($data->type_of_alert== 'ra'){$alert2='checked';}else{$alert2='';}
        if($data->type_of_alert== 'ta'){$alert3='checked';}else{$alert3='';}


        if($data->ra_followed== 'yes'){$followed1='checked';}else{$followed1='';}
        if($data->ra_followed== 'no'){$followed2='checked';}else{$followed2='';}

        if($data->level_of_risk== 'none'){$risk1='checked';}else{$risk1='';}
        if($data->level_of_risk== 'low'){$risk2='checked';}else{$risk2='';}
        if($data->level_of_risk== 'medium'){$risk3='checked';}else{$risk3='';}
        if($data->level_of_risk== 'high'){$risk4='checked';}else{$risk4='';}

        if($data->evasive_actions== 'yes'){$evasive1='checked';}else{$evasive1='';}
        if($data->evasive_actions== 'no'){$evasive2='checked';}else{$evasive2='';}

        if($data->reported_to_atc== 'yes'){$reported1='checked';}else{$reported1='';}
        if($data->reported_to_atc== 'no'){$reported2='checked';}else{$reported2='';}

        if($data->atc_instruction== 'none'){$instruction1='checked';}else{$instruction1='';}
        if($data->atc_instruction== 'climb'){$instruction2='checked';}else{$instruction2='';}
        if($data->atc_instruction== 'descent'){$instruction3='checked';}else{$instruction3='';}
        if($data->atc_instruction== 'turn_left'){$instruction4='checked';}else{$instruction4='';}
        if($data->atc_instruction== 'turn_right'){$instruction5='checked';}else{$instruction5='';}

        if($data->advice_earlier== 'yes'){$advice1='checked';}else{$advice1='';}
        if($data->advice_earlier== 'no'){$advice2='checked';}else{$advice2='';}

        if($data->conditions_of_the_sky== 'clear'){$sky1='checked';}else{$sky1='';}
        if($data->conditions_of_the_sky== 'clouded'){$sky2='checked';}else{$sky2='';}
        if($data->conditions_of_the_sky== 'dark'){$sky3='checked';}else{$sky3='';}

        if($data->course_ac== 'none'){$course1='checked';}else{$course1='';}
        if($data->course_ac== 'right'){$course2='checked';}else{$course2='';}
        if($data->course_ac== 'left'){$course3='checked';}else{$course3='';}

        if($data->glidslope_position== 'hi'){$glidslope1='checked';}else{$glidslope1='';}
        if($data->glidslope_position== 'low'){$glidslope2='checked';}else{$glidslope2='';}
        if($data->glidslope_position== 'on'){$glidslope3='checked';}else{$glidslope3='';}

        if($data->pos_extended_center== 'left'){$extended1='checked';}else{$extended1='';}
        if($data->pos_extended_center== 'right'){$extended2='checked';}else{$extended2='';}
        if($data->pos_extended_center== 'on'){$extended3='checked';}else{$extended3='';}

        if($data->function_position== 'crew'){$function1='checked';}else{$function1='';}
        if($data->function_position== 'ground'){$function2='checked';}else{$function2='';}
        if($data->function_position== 'other'){$function3='checked';}else{$function3='';}


        if($data->type_of_influence== 'crew_actions'){$influence1='checked';}else{$influence1='';}
        if($data->type_of_influence== 'external'){$influence2='checked';}else{$influence2='';}
        if($data->type_of_influence== 'organizational'){$influence3='checked';}else{$influence3='';}
        if($data->type_of_influence== 'personal'){$influence4='checked';}else{$influence4='';}

        $html = '

<style>
    .tbl {
        margin-bottom: 0px !important;
        border: 2px solid;
        border-bottom: 0px !important;
        width: 100%;
        font-family: Arial !important;
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
    text-align: left; font-weight: normal; padding: 0px 0px 0px 5px; font-size:13px;
    }

    .tbl2 tr td {
        padding:0px; text-align: left;
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
        <div class="panel-body" style="border:3px solid #000000">

            <!--<table cellspacing="0" cellpadding="0" class="tbl3">
                <tr>
                    <th width="50%" class="report_img2">
                        '.$img2.'
                        <br><span style="font-weight: bolder; font-size:20px;">SAFETY MANAGEMENT MANUAL</span>
                    </th>
                    <th style="border-left: 2px solid; padding:2%;" width="46%">
                        <p style="font-weight: bolder; font-size:20px;" align="left">5 &nbsp;&nbsp; APPENDICES</p>
                        <p style="font-weight: bolder; font-size:20px;" align="left">B &nbsp;&nbsp; Operational Safety Report (OSR)</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">B. OPERATIONAL SAFETY REPORT</span>
            </table>
            <br>
            <br>
            <br>-->

            <table cellspacing="0" cellpadding="0" class="tbl">
                <tr>
                    <th rowspan="2" style="border-right: 2px solid" width="33%" class="report_img">
                        '.$img.'</th>
                    <th rowspan="2" style="border-right: 2px solid" width="33%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">OSR</p>
                        <p style="height: 25px"; align="center"><font size="+2";><u>Operational Safety</u></font></p>
                        <p style="height: 25px" align="center"><font size="+2";><u>Report</u></font></p>
                    </th>
                    <th style="border-bottom: 2px solid; font-size: 20px; vertical-align: top;text-align: left;">Safety Department <br> ref. nr : '.$data->reference_no.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">AIR SAFETY REPORT</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="no-spacing tbl2">
                <tr>

                    <th style="text-align: center" colspan="6"><span style="background-color: yellow; padding:5px;"">GENERAL INFORMATION</span></th>

                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="6">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : '.$data->full_name.','.$data->email.','.$data->telephone.','.$data->extension.','.$data->fax.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="32%" style="border: 2px solid" colspan="2">
                        2. CAPTAIN : '.$data->captain.'<br>
                        PF<input type="checkbox" name="pf_pnf" value=""  '.$pf.' style="display:inline;" >
                        PNF<input type="checkbox" name="pf_pnf" value="" '.$pnf.' style="display:inline;" >
                    </th>
                    <th width="32%" style="border: 2px solid" colspan="2">
                        3. CO-PILOT : '.$data->co_pilot.' <br>
                        PF<input type="checkbox" name="pf_pnf2" value=""  '.$pf2.' style="display:inline;" >
                        PNF<input type="checkbox" name="pf_pnf2" value="" '.$pnf2.' style="display:inline;" >

                        </th>
                    <th width="36%" style="border: 2px solid;" colspan="2">4. OTHER : '.$data->others.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid"> Year : '.$data->year.'</th>
                    <th width="32%" style="border: 2px solid">5. DATE : '.date("M d, Y", strtotime($data->date)).'</th>
                    <th width="16%" style="border: 2px solid">
                        6. TIME : '.$data->time.' <br>
                        UTC<input type="checkbox" name="utc_local" value=""  '.$checked_utc.' style="display:inline;" >
                        Local<input type="checkbox" name="utc_local" value="" '.$checked_local.' style="display:inline;" >
                    </th>
                    <th width="16%" style="border: 2px solid">7. AIRCRAFT TYPE : '.$data->air_craft_time.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">8. REGISTRATION : '.$data->registration.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">9. FLIGHT NUMBER : '.$data->flight_no.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">10. FROM : '.$data->from.'</th>
                    <th width="16%" style="border: 2px solid">11. TO : '.$data->to.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">12. POSITION (geogr. Co-ord) : '.$data->position.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">13. ALTITUDE : '.$data->altitude.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">14. SPEED/MACH : '.$data->speed.'</th>
                    <th width="16%" style="border: 2px solid">15. ACTUAL WEIGHT : '.$data->actual_weight.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">16. REMAINING FUEL : '.$data->remaining_fuel.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">17. ATL REF. : '.$data->atl_ref.'</th>
                    <th width="32%" style="border: 2px solid">18. DELAY (min) : '.$data->delay.'</th>
                    <th width="16%" style="border: 2px solid">19. DIVERSION : '.$data->diversion.'</th>
                    <th width="16%" style="border: 2px solid">20. NR CREW : '.$data->nr_crew.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">21. NR. PAX : '.$data->nr_pax.'</th>
                </tr>
                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid" colspan="6">
                        22. FLIGHT PHASE : '.$data->flight_phase.'
                        <br>
                   PARKED <input type="checkbox" name="flight_phase" value=""  '.$fp1.' style="display:inline;" >  &nbsp;&nbsp;&nbsp;&nbsp;
                    PUSH BACK<input type="checkbox" name="flight_phase" value=""  '.$fp2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    TAXI OUT<input type="checkbox" name="flight_phase" value=""  '.$fp3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    TAKE OFF<input type="checkbox" name="flight_phase" value=""  '.$fp4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    INITIAL CLIMB<input type="checkbox" name="flight_phase" value=""  '.$fp5.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    CLIMB<input type="checkbox" name="flight_phase" value=""  '.$fp6.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    CRUISE<input type="checkbox" name="flight_phase" value=""  '.$fp7.' style="display:inline;" >  &nbsp;&nbsp;&nbsp;&nbsp;
                    HOLDING<input type="checkbox" name="flight_phase" value=""  '.$fp8.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    DESCENT<input type="checkbox" name="flight_phase" value=""  '.$fp9.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    APPROACH<input type="checkbox" name="flight_phase" value=""  '.$fp10.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                   LANDING <input type="checkbox" name="flight_phase" value=""  '.$fp11.' style="display:inline;" > &nbsp;&nbsp;
                    TAXI IN<input type="checkbox" name="flight_phase" value=""  '.$fp12.' style="display:inline;" >
                    </th>
                </tr>
                <tr style="vertical-align: top;">
                    <th width="100%" height="340px" style="border: 2px solid" colspan="6">
                        23. DESCRIPTION OF OCCURRENCE ( add forms if necessary) :
                        <p>'.$data->description_of_occurence.'</p>
                    </th>
                </tr>
                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid" colspan="6">
                        Please sent this information to the Safety Department at your earliest convenience but no later than 24 hours after the occurrence,<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;via fax <b>+597430230</b> or via e-mail : <u><strong>safety@flyslm.com</strong></u>
                    </th>
                </tr>
                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid" colspan="6">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This form can also be submitted via the company website:<b>www.flyslm.com</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page 1 of 2
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You may report anonymously
                    </th>
                </tr>
            </table>
            </div>

            <table style="width:100%;">
                <tr style="vertical-align: top;border:0px ! important">
                    <th width="50%" style="text-align:left; border:0"  colspan="3">
                        <b>15 Feb 2015</b> <br><b>Revision : 9</b>
                    </th>
                    <th width="50%" style="text-align:right; border:0px !important" colspan="3">
                        <b>SA - 99925</b>
                    </th>
                </tr>

                </table>

                <br>



                <div style="border:3px solid #000000">


                <table cellspacing="0" cellpadding="0" class="tbl" border="1">
                <tr>
                    <th rowspan="2" style="border-right: 2px solid" width="33%" class="report_img">
                        '.$img.'</th>
                    <th rowspan="2" style="border-right: 2px solid" width="33%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">OSR</p>
                        <p style="height: 25px"; align="center"><font size="+2";><u>Operational Safety</u></font></p>
                        <p style="height: 25px" align="center"><font size="+2";><u>Report</u></font></p>
                    </th>
                    <th style="border-bottom: 2px solid; font-size: 20px; vertical-align: top;text-align: left;">Safety Department <br> ref. nr : '.$data->reference_no.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">AIR SAFETY REPORT</th>
                </tr>
            </table>

                <table cellpadding="0" cellspacing="0" class="no-spacing tbl2">
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center;" colspan="6"><span style="background-color: yellow; padding:5px;"">METEOROLOGICAL INFORMATION</span></span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">24. IMC/VMC : '.$data->imc_vmc.'</th>
                    <th width="32%" style="border: 2px solid" colspan="2">25. VCM (km) : '.$data->vmc_km.'</th>
                    <th width="16%" style="border: 2px solid">26. WIND DIRECTION (deg) : '.$data->wind_direction.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">
                        27. WIND SPEED :
                        <br>
                    KM/HR<input type="checkbox" name="wind_speed" value=""  '.$ws1.' style="display:inline;" >  &nbsp;&nbsp;&nbsp;&nbsp;
                    KNOTH<input type="checkbox" name="wind_speed" value=""  '.$ws2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">28. VISIBILITY : '.$data->visibility.'</th>
                    <th width="32%" style="border: 2px solid">29. CEILING : '.$data->ceiling.'</th>
                    <th width="16%" style="border: 2px solid">30. CLOUDS : '.$data->clouds.'</th>
                    <th width="16%" style="border: 2px solid">31. TEMPERATURE : '.$data->temperature.'</th>
                    <th width="36%" style="border: 2px solid" colspan="2">32. QNH : '.$data->qnh.'</th>
                </tr>

                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid" colspan="6">
                        33. WEATHER CONDITION :
                        <br>
                        SOFT<input type="checkbox" name="weather_condition" value=""  '.$weather1.' style="display:inline;" >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        MODERATE<input type="checkbox" name="weather_condition" value=""  '.$weather2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       SEVERE <input type="checkbox" name="weather_condition" value=""  '.$weather3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       TURBULENCE <input type="checkbox" name="weather_condition" value=""  '.$weather4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        WIND-SHEAR<input type="checkbox" name="weather_condition" value=""  '.$weather5.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                        RAIN<input type="checkbox" name="weather_condition" value=""  '.$weather6.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        HAIL<input type="checkbox" name="weather_condition" value=""  '.$weather7.' style="display:inline;" >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        MIST<input type="checkbox" name="weather_condition" value=""  '.$weather8.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        FOG<input type="checkbox" name="weather_condition" value=""  '.$weather9.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        SNOW<input type="checkbox" name="weather_condition" value=""  '.$weather10.' style="display:inline;" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">34. RUNWAY : '.$data->runway.'</th>
                    <th width="48%" style="border: 2px solid" colspan="4">35. RUNWAY CONDITION :
                    <br>
                    Dry<input type="checkbox" name="runway_condition" value=""  '.$runway1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    Wet<input type="checkbox" name="runway_condition" value=""  '.$runway2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    Mist<input type="checkbox" name="runway_condition" value=""  '.$runway3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    Snow<input type="checkbox" name="runway_condition" value=""  '.$runway4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="20%" style="border: 2px solid">36. RVR (M) : '.$data->rvr.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid">37. AUTO PILOT : '.$data->auto_pilot.'</th>
                    <th width="32%" style="border: 2px solid">38. AUTO THRUST : '.$data->auto_thrust.'</th>
                    <th width="16%" style="border: 2px solid">
                        39. GEAR :
                        <br>
                        UP<input type="checkbox" name="gear" value=""  '.$gear1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        DOWN<input type="checkbox" name="gear" value=""  '.$gear2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;

                    </th>
                    <th width="16%" style="border: 2px solid">40. FLAP : '.$data->flap.'</th>
                    <th width="36%" style="border: 2px solid">41. SLAT : '.$data->slat.'</th>
                    <th width="36%" style="border: 2px solid">42. SPOILERS : '.$data->spoilers.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center;" colspan="6"><span style="background-color: yellow; padding:5px;"">TCAS INFORMATION (traffic)</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        43. TYPE OF ALERT :
                        <br>
                        None<input type="checkbox" name="type_of_alert" value=""  '.$alert1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        RA<input type="checkbox" name="type_of_alert" value=""  '.$alert2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        TA<input type="checkbox" name="type_of_alert" value=""  '.$alert2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">44. TYPE OF RA : '.$data->type_of_ra.'</th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        45. RA FOLLOWED? :
                        <br>
                        YES<input type="checkbox" name="ra_followed" value=""  '.$followed1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        NO<input type="checkbox" name="ra_followed" value=""  '.$followed2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center;" colspan="6"><span style="background-color: yellow; padding:5px;"">ATC PROCEDURES</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        46. LEVEL OF RISK :
                        <br>
                        None<input type="checkbox" name="level_of_risk" value=""  '.$risk1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        LOW<input type="checkbox" name="level_of_risk" value=""  '.$risk2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        MEDIUM<input type="checkbox" name="level_of_risk" value=""  '.$risk3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        HIGH<input type="checkbox" name="level_of_risk" value=""  '.$risk4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="48%" style="border: 2px solid" colspan="2">
                        47. EVASIVE ACTIONS :
                        <br>
                        YES<input type="checkbox" name="evasive_actions" value=""  '.$evasive1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        NO<input type="checkbox" name="evasive_actions" value=""  '.$evasive2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="20%" style="border: 2px solid" colspan="2">
                        48. REPORTED TO ATC? :
                        <br>
                        YES<input type="checkbox" name="reported_to_atc" value=""  '.$reported1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        NO<input type="checkbox" name="reported_to_atc" value=""  '.$reported2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                </tr>

                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="16%" style="border: 2px solid" colspan="2">
                        49. ATC INSTUCTIONS :
                        <br>
                       None <input type="checkbox" name="atc_instruction" value=""  '.$instruction1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        CLIMB<input type="checkbox" name="atc_instruction" value=""  '.$instruction2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                      DESCENT  <input type="checkbox" name="atc_instruction" value=""  '.$instruction3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        TURN LEFT<input type="checkbox" name="atc_instruction" value=""  '.$instruction4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                       TURN RIGHT <input type="checkbox" name="atc_instruction" value=""  '.$instruction5.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
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
                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid" colspan="6">
                        52. HEADING OF THE OTHER AC :
                        '.$data->heading_other_ac.'
                    </th>
                </tr>
                <tr style="vertical-align: top;">
                    <th width="100%" style="border: 2px solid; text-align: center;" colspan="6"><span style="background-color: yellow; padding:5px;"">AIRPROX</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
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
                    <th width="100%" style="border: 2px solid; text-align: center; " colspan="6"><span style="background-color: yellow; padding:5px;"">BIRD STRIKE</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
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

                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        59. ADVISED EARLIER? :
                        <br>
                        YES<input type="checkbox" name="advice_earlier" value=""  '.$advice1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        NO<input type="checkbox" name="advice_earlier" value=""  '.$advice2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        60. LIGHTING CONDITIONS :
                        '.$data->lighting_conditions.'
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        61. CODITION OF THE SKY :
                        <br>
                        CLEAR<input type="checkbox" name="conditions_of_the_sky" value=""  '.$sky1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                       CLOUDED <input type="checkbox" name="conditions_of_the_sky" value=""  '.$sky2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        DARK<input type="checkbox" name="conditions_of_the_sky" value=""  '.$sky3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; " colspan="6"><span style="background-color: yellow; padding:5px;"">TURBULANCE</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        62. Course of the AC :
                        <br>
                        NONE<input type="checkbox" name="course_ac" value=""  '.$course1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                       RIGHT <input type="checkbox" name="course_ac" value=""  '.$course2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                       LEFT <input type="checkbox" name="course_ac" value=""  '.$course3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        63. GLIDSLOPE POSITION :
                        <br>
                        HI<input type="checkbox" name="glidslope_position" value=""  '.$glidslope1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        LOW<input type="checkbox" name="glidslope_position" value=""  '.$glidslope2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        ON<input type="checkbox" name="glidslope_position" value=""  '.$glidslope3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        64. POS. ON EXTENDED CENTR. LINE. :
                        <br>
                       LEFT <input type="checkbox" name="pos_extended_center" value=""  '.$extended1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        RIGHT<input type="checkbox" name="pos_extended_center" value=""  '.$extended2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        ON<input type="checkbox" name="pos_extended_center" value=""  '.$extended3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                    </th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        65. CHANGE IN PITCH (deg) :'.$data->change_in_pitch.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        66. CHANGE IN ROLL (deg) :'.$data->change_in_roll.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        67. CHANGE IN YAW (deg) :'.$data->change_in_yaw.'</th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="2">
                        68. CHANGE IN ALT. :'.$data->change_in_alt.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        69. SPEED BUFFET? :'.$data->speed_buffet.'</th>
                    <th width="52%" style="border: 2px solid" colspan="2">
                        70. STICKSHAKER? :'.$data->stickshaker.'</th>
                </tr>

                </table>
                </div>

<br>
                <div style="border:3px solid #000000">


                <table cellspacing="0" cellpadding="0" class="tbl" border="1">
                <tr>
                    <th rowspan="2" style="border-right: 2px solid" width="33%" class="report_img">
                        '.$img.'</th>
                    <th rowspan="2" style="border-right: 2px solid" width="33%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">OSR</p>
                        <p style="height: 25px"; align="center"><font size="+2";><u>Operational Safety</u></font></p>
                        <p style="height: 25px" align="center"><font size="+2";><u>Report</u></font></p>
                    </th>
                    <th style="border-bottom: 2px solid; font-size: 20px; vertical-align: top;text-align: left;">Safety Department <br> ref. nr : '.$data->reference_no.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">AIR SAFETY REPORT</th>
                </tr>
            </table>

                <table cellpadding="0" cellspacing="0" class="no-spacing tbl2">
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        71. SUSPECTED WAKE TURBULANCE :'.$data->suspected_wake_turbulance.'</th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        72. SIGN. VERTICAL ACCELARATION :'.$data->sign_verticle_accelaration.'</th>

                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        73. DETAILS OF AC WAKE TURBULANCE? :'.$data->details_ac_wake_turbulance.'</th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        74. ADVISE TO OTHER AIRCRAFT :'.$data->advice_other_aircraft.'</th>

                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; " colspan="6"><span style="background-color: yellow; padding:5px;"">HUMAN FACTORS</span></th>
                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="3">
                        75. PERSON INVOLVED (name) [ optional field] :'.$data->persion_involved.'</th>
                    <th width="52%" style="border: 2px solid" colspan="3">
                        76. FUNCTION/POSITION :
                        <br>
                        Crew<input type="checkbox" name="function_position" value=""  '.$function1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        Ground<input type="checkbox" name="function_position" value=""  '.$function2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        Other<input type="checkbox" name="function_position" value=""  '.$function3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        </th>

                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
                    <th width="48%" style="border: 2px solid" colspan="6">
                        77. TYPE OF INFLUENCE :
                        <br>
                        Crew actions<input type="checkbox" name="type_of_influence" value=""  '.$influence1.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        External<input type="checkbox" name="type_of_influence" value=""  '.$influence2.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        Organizational<input type="checkbox" name="type_of_influence" value=""  '.$influence3.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        Personal<input type="checkbox" name="type_of_influence" value=""  '.$influence4.' style="display:inline;" > &nbsp;&nbsp;&nbsp;
                        </th>

                </tr>
                <tr style="border: 2px solid; vertical-align: top;">
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
        $dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
        $dompdf->render();

        $downloadfolder = public_path().'/pdf_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $output = $dompdf->output();
        file_put_contents($downloadfolder.'AIR_SAFETY_REPORT.pdf', $output);

        $file = $downloadfolder.'/AIR_SAFETY_REPORT.pdf';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'AIR_SAFETY_REPORT.pdf', $headers);

// Output the generated PDF to Browser
        //$dompdf->stream();
    }



}