<?php

namespace App\Modules\Slm\Controllers;

use App\Helpers\LogFileHelper;
use App\Safety;
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


    public function edit($id)
    {
        $pageTitle = "Update Air Safety Informations";
        $data = Safety::where('id',$id)->first();
        return view('slm::air_safety.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        //$input['slug'] = str_slug(strtolower($input['title']));

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

}