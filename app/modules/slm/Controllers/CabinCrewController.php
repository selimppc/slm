<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/9/16
 * Time: 9:57 AM
 */

namespace App\Modules\Slm\Controllers;

use App\Helpers\LogFileHelper;
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
use App\Modules\Slm\Models\CabinCrew;
use App\Modules\User\Models\UserSignature;

use Dompdf\Dompdf;



class CabinCrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Cabin Crew\'s';
//        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data['cabin_crews'] = CabinCrew::paginate(10);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::cabin_crew.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle']='Add Cabin Crew';
        return view('slm::cabin_crew.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');

        $data['date']=date("Y-m-d", strtotime($data['date']));
        $data['created_at'] = date('Y-m-d H:i:s');
        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
        //print_r($user);exit;


        if(CabinCrew::insert($data)) {

            try{
                Mail::send('slm::cabin_crew.mail_notification', array('model'=>$data),
                    function($message) use ($user)
                    {
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        $message->to($user->email);
                        //$message->to('pothiceee@gmail.com');
                        //$message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Cabin Crew added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Cabin crew has been successfully stored.');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Does not Save!');
        }

        return redirect()->route('cabin-crew');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['pageTitle']='Show Cabin Crew Details';
        $data['cabin_crew']=CabinCrew::findOrFail($id);

        return view('slm::cabin_crew.view',$data);
    }

    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = CabinCrew::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."CabinCrew.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'NAME','EMAIL', 'TELEPHONE', 'EXTENSION','FAX','CAPTAIN','PF/PNF','CO-PILOT','PF/PNF','OTHER','PURSER','DATE','TIME','UTC/LOCAL','AIRCRAFT TYPE','REGISTRATION','FLIGHT NUMBER','FROM','TO','FLT DIVERTED TO','ASSIGNED DOOR','POS. DURING EVEN','NR. PAX','NR CREW','PREVIOUS FLIGHTS','NR OF LANDINGS OF THE DAY','FLIGHT PHASE','DESCRIPTION OF OCCURRENCE'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {
            fputcsv($handle, array($row['full_name'], $row['email'], $row['telephone'], $row['extension'], $row['fax'], $row['captain'],$row['pf_pnf'], $row['co_pilot'],$row['pf_pnf2'], $row['others'],$row['purser'],$row['date'], $row['time'],$row['utc_local'],$row['air_craft_type'],$row['registration'],$row['flight_no'], $row['from'], $row['to'],$row['flt_diverted_to'],$row['assigned_door'],$row['position_during_event'],$row['nr_of_pax'],$row['nr_of_crew'],$row['previous_flights'],$row['nr_of_landings_of_the_day'],$row['flight_phase'],$row['description_of_occurrence']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'CabinCrew.csv', $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle']='Edit Cabin Crew Details';
        $data['cabin_crew']=CabinCrew::findOrFail($id);
        $data['cabin_crew_verification'] = CabinCrew::where('id',$id)->first();

        //print_r($data['cabin_crew']['date']);exit;

        $data['cabin_crew']['date']=date("M d, Y", strtotime($data['cabin_crew']['date']));

        return view('slm::cabin_crew.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token','_method');

        $data['date']=date("Y-m-d", strtotime($data['date']));

        CabinCrew::where('id',$id)->update($data);
        Session::flash('message', 'Cabin Crew has been successfully updated');

        return redirect()->route('cabin-crew');
    }

    public function sent_receive_form($id)
    {
        $pageTitle = "Send Receive Form";
        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id',$user_id)->first();
        //$signature = DB::table('user_signature')->where('user_id',$id)->get();
        //print_r($signature); exit();

        return view('slm::cabin_crew.send_receive', ['data' => $id,'pageTitle'=> $pageTitle,'signature'=>$signature]);
    }

    public function update_send_receive(Request $request, $id)
    {
        $input = $request->all();
        $model = CabinCrew::where('id', $id)->get();

        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id', $user_id)->first();
        //print_r($signature->image); exit();
        //$user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $user = DB::table('cabin_crew')->where('id', $id)->first();

        $data_signature['image_path'] = $signature->image;
        $data_signature['image_thumb'] = $signature->thumbnail;
        $data_signature['current_date'] = date('M d, Y');
        $data_signature['created_at'] = (date("M d, Y", strtotime($model[0]['created_at'])));
        $data_signature['regards'] = $input['regards'];
        $data_signature['full_name'] = $user->full_name;
        $data_signature['report'] = 'Cabin Crew Report';

        try {
            Mail::send('slm::cabin_crew.mail_send_receive', array('ground_handling' => $data_signature),
                function ($message) use ($user) {
                    //$message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                    $message->from('devdhaka405@gmail.com', 'SLM');
                    $message->to($user->email);
                    //$message->to($user->email);
                    //$message->to('selimppc@gmail.com');
                    //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                    $message->subject('New Cabin Crew added');
                });

            $data2['sent_receive'] = 1;

            CabinCrew::where('id', $id)->update($data2);

            #print_r($user);exit;
            Session::flash('message', 'Cabin Crew Report has been Sent Successfully');
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
            return redirect()->previous();
        }
        return redirect()->route('cabin-crew');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CabinCrew::where('id',$id)->delete($id);
        Session::flash('message', 'Cabin Crew has been successfully deleted');

        return redirect()->back();
    }

    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $cabin_crew=CabinCrew::findOrFail($id);

        /*$image_path = public_path().'/assets/img/report.jpg';
        $image_path2 = public_path().'/assets/img/report_black.jpg';*/
        $image_path = public_path().'/assets/img/slm-logo-main.png';
        $image_path2 = public_path().'/assets/img/slm-logo-for-pdf.png';
        $img = '<img src="'.$image_path.'" alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'" alt="Surinam Airways" >';

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
                <span style="font-weight: bolder; font-size:20px;">B.II OSR – CABIN CREW</span>
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
                    <th style="border-bottom: 2px solid; font-size: 20px; text-align: center;">Safety Department ref. nr : '.$cabin_crew->reference_no.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">CABIN CREW REPORT</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-bordered table-responsive no-spacing tbl2">
                <tr>
                    <th style="text-align: center; background-color: yellow" colspan="5">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th colspan="5">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : '.$cabin_crew->full_name.','.$cabin_crew->email.','.$cabin_crew->telephone.','.$cabin_crew->extension.','.$cabin_crew->fax.'</th>
                </tr>
                <tr>
                    <th width="40%" style="border: 2px solid" colspan="2">
                        2. CAPTAIN :'.$cabin_crew->captain.'
                        <input type="checkbox" name="pf_pnf" value=""  '.$pf.' style="display:inline;" > PF
                        <input type="checkbox" name="pf_pnf" value="" '.$pnf.' style="display:inline;" >  PNF
                    </th>
                    <th width="40%" style="border: 2px solid" colspan="2">
                        3. CO-PILOT : '.$cabin_crew->co_pilot.'
                        <input type="checkbox" name="pf_pnf2" value=""  '.$pf2.' style="display:inline;" > PF
                        <input type="checkbox" name="pf_pnf2" value="" '.$pnf2.' style="display:inline;" >  PNF
                    </th>
                    <th width="20%" style="border: 2px solid">4. OTHER : '.$cabin_crew->others.'</th>
                </tr>
                <tr>
                    <th colspan="2">5. PURSER : '.$cabin_crew->purser.'</th>
                    <th>6. DATE : '.date("M d, Y", strtotime($cabin_crew->date)).'</th>

                    <th>
                        7. TIME : '.$cabin_crew->time.'
                        <input type="checkbox" name="utc_local" value=""  '.$checked_utc.' style="display:inline;" > UTC
                        <input type="checkbox" name="utc_local" value="" '.$checked_local.' style="display:inline;" >  Local
                    </th>
                    <th>8. AIRCRAFT TYPE : '.$cabin_crew->air_craft_type.'</th>
                </tr>
                <tr>
                    <th>9. REGISTRATION : '.$cabin_crew->registration.'</th>
                    <th>10. FLIGHT NR. : '.$cabin_crew->flight_no.'</th>
                    <th">11. FROM : '.$cabin_crew->from.'</th>
                    <th>12. TO : '.$cabin_crew->to.'</th>
                    <th>13. FLT DIVERTED TO : '.$cabin_crew->flt_diverted_to.'</th>
                </tr>
                <tr>
                    <th colspan="2">14. ASSIGNED DOOR : '.$cabin_crew->assigned_door.'</th>
                    <th>15. POS. DURING EVENT : '.$cabin_crew->position_during_event.'</th>
                    <th>16. NR OF PAX : '.$cabin_crew->nr_of_pax.'</th>
                    <th>17. NR OF CREW : '.$cabin_crew->nr_of_crew.'</th>
                </tr>
                <tr>
                    <th colspan="5">18. PREVIOUS FLIGHTS : '.$cabin_crew->previous_flights.'</th>
                </tr>
                <tr>
                    <th colspan="5">19. NR OF LANDINGS OF THE DAY : '.$cabin_crew->nr_of_landings_of_the_day.'</th>
                </tr>
                <tr>
                    <th colspan="5">20. FLIGHT PHASE: '.$cabin_crew->flight_phase.'
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
                    <th colspan="5">21. DESCRIPTION OF OCCURRENCE ( add forms if necessary):'.$cabin_crew->description_of_occurrence.' </th>
                </tr>
                <tr>
                    <th colspan="5">Please sent this information to the Safety Department at your earliest convenience but no later than 24 hours after the occurrence, via fax +597 430230 or via e-mail : safety@slm.firm.sr</th>
                </tr>
                <tr>
                    <th colspan="5">This form can also be submitted via the company website: www.flyslm.com
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
        //$dompdf->stream();

        $downloadfolder = public_path().'/pdf_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $output = $dompdf->output();
        file_put_contents($downloadfolder.'CABIN_CREW_REPORT.pdf', $output);

        $file = $downloadfolder.'/CABIN_CREW_REPORT.pdf';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'CABIN_CREW_REPORT.pdf', $headers);
    }


}
