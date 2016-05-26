<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 4:35 PM
 */

namespace App\Modules\Slm\Controllers;

use App\Helpers\ImageResize;
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
use App\Modules\Slm\Models\GroundHandling;
use App\Modules\User\Models\UserSignature;


use Validator;
use Dompdf\Dompdf;


class GroundHandlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Ground Handling';
//        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data['ground_handling'] = GroundHandling::paginate(10);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::ground_handling.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle']='Add Ground Handling';
        return view('slm::ground_handling.create',$data);
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


        if(GroundHandling::insert($data)) {

            try{
                Mail::send('slm::ground_handling.mail_notification', array('ground_handling'=>$data),
                    function($message) use ($user)
                    {
//                        $message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        //$message->to($user->email);
                        $message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Ground Handling added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Ground Handling has been successfully stored');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
                return redirect()->previous();
            }
        }else{
            Session::flash('error', 'Does not Save!');
            return redirect()->previous();
        }

        return redirect()->route('ground-handling');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle']='Show Ground Handling Details';
        $data['ground_handling']=GroundHandling::findOrFail($id);
        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id',$user_id)->first();
        $data['signature'] = $signature->image;

        return view('slm::ground_handling.view',$data);
    }

    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = GroundHandling::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."GroundHandling.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'NAME','EMAIL', 'TELEPHONE', 'EXTENSION','FAX','LOCATION OF OCCURRENCE','RAMP CONDITION','DATE','TIME','UTC/Local','OPERATIONAL PHASE','OPERATOR','FLIGHT NUMBER','AIRCRAFT TYPE','REGISTRATION','FROM','TO','DELAY (min)','DIVERSION','THIRD PARTY INVOLVED (Contractor)','DESCRIPTION OF OCCURRENCE ( add forms if necessary)','ORIGIN OF THE GOODS','IATA UN/ID','CLASS / DIVISION','SUBSIDIARY RISK','PACKING GROUP','CLASS 7 CATEGORY','TYPE OF PACKING ','PACKING SPEC. MARKING ','NUMBER OF PACKAGES','QUANTITY-OF TRANSPORT INDEX','AIRWAY-BILL REFERENCE','COURIER POUCH /BAG TAG/ TKT REF','SHIPPING AGENT','SHIPPING NAME','DAMAGE TO','DAMAGE BY','AREA (STAND)','ENVIROMENTAL CONDITIONS (weather, surface, lighting)','DETAILS OF DAMAGE (add forms if necessary)'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {

            fputcsv($handle, array($row['full_name'], $row['email'], $row['telephone'], $row['extension'], $row['fax'],$row['location_of_occurrence'],$row['ramp_condition'], $row['date'],$row['time'], $row['utc_local'],$row['operational_phase'], $row['operator'],$row['flight_number'],$row['aircraft_type'], $row['registration'], $row['from'], $row['to'],$row['delay'], $row['diversion'],$row['third_party_involved'],  $row['description_of_occurrence'],$row['origin_of_the_goods'], $row['iata_un_or_id'], $row['class_or_division'], $row['subsidiary_risk'],$row['packing_group'],  $row['class_7_category'], $row['type_of_packing'], $row['packing_spec_marking'],$row['number_of_packages'],$row['quantity_of_transport_index'],$row['airway_bill_reference'],$row['courier_pouch_reference'],$row['shipping_agent'],$row['shipping_name'],$row['damage_to'],$row['damage_by'],$row['area'],$row['enviromental_condition'],$row['details_of_damage']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'GroundHandling.csv', $headers);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle']='Edit Ground Handling Details';
        $data['ground_handling']=GroundHandling::findOrFail($id);
        $data['ground_handling_verification'] = GroundHandling::where('id',$id)->first();


        $data['ground_handling']['date']=date("M d, Y", strtotime($data['ground_handling']['date']));

        return view('slm::ground_handling.edit',$data);
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

        GroundHandling::where('id',$id)->update($data);
        Session::flash('message', 'Ground Handling has been successfully updated');

        return redirect()->route('ground-handling');
    }


    public function reference_no($id)
    {
        $pageTitle = "Add Reference Number";
        return view('slm::ground_handling.reference', ['data' => $id,'pageTitle'=> $pageTitle]);
    }


    public function update_reference(Request $request, $id)
    {
        //print_r($id);exit;
        $input = $request->all();
        $data['reference_no']=@$input['reference_no'];
        GroundHandling::where('id',$id)->update($data);
        Session::flash('message', 'Ground Handling Reference number has been successfully updated');

        return redirect()->route('ground-handling');
    }

    public function sent_receive_form($id)
    {
        $pageTitle = "Send Receive Form";
        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id',$user_id)->first();
        //$signature = DB::table('user_signature')->where('user_id',$id)->get();

        return view('slm::ground_handling.send_receive', ['data' => $id,'pageTitle'=> $pageTitle,'signature'=>$signature]);
    }

    public function update_send_receive(Request $request, $id)
    {
        $input = $request->all();
        $model = GroundHandling::where('id', $id)->get();

        //print_r(@$model[0]['created_at']);exit;

        //print_r(date("M d, Y", strtotime($model[0]['created_at'])));exit;

        /*if(count($image)>0)
        {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/signature/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = GroundHandlingController::image_upload($image, $file_type_required, $destinationPath);

            $user = DB::table('user')->where('username', '=', 'super-admin')->first();

            if ($file_name != '') {

               //print_r($imdata);exit;

                $data_signature['image_path'] = $file_name[0];
                $data_signature['image_thumb'] = $file_name[1];
                $data_signature['current_date'] = date('M d, Y');
                $data_signature['created_at'] = (date("M d, Y", strtotime($model[0]['created_at'])));
                $data_signature['regards'] =  $input['regards'];

                //print_r($data_signature);exit;

                try{
                    Mail::send('slm::ground_handling.mail_send_receive', array('ground_handling'=>$data_signature),
                        function($message) use ($user)
                        {
//                        $message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                            $message->from('devdhaka405@gmail.com', 'SLM');
                            $message->to($user->email);
                            //$message->to('selimppc@gmail.com');
                            //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                            $message->subject('New Ground Handling added');
                        });

                    unlink(public_path()."/".$file_name[0]);
                    unlink(public_path()."/".$file_name[1]);

                    $data2['sent_receive'] = 1;

                    GroundHandling::where('id',$id)->update($data2);

                    #print_r($user);exit;
                    Session::flash('message', 'Ground Handling has been successfully stored');
                }catch (\Exception $e){

                    Session::flash('error', $e->getMessage());
                    return redirect()->previous();
                }
            } else {
                Session::flash('flash_message_error', 'Some thing error in image file type! Please Try again');
            }
        }*/

        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id', $user_id)->first();

        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $data_signature['image_path'] = $signature->image;
        $data_signature['image_thumb'] = $signature->thumbnail;
        $data_signature['current_date'] = date('M d, Y');
        $data_signature['created_at'] = (date("M d, Y", strtotime($model[0]['created_at'])));
        $data_signature['regards'] = $input['regards'];

            try {
                Mail::send('slm::ground_handling.mail_send_receive', array('ground_handling' => $data_signature),
                    function ($message) use ($user) {
                       $message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        $message->to($user->email);
                        //$message->to('selimppc@gmail.com');
                        //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Ground Handling added');
                    });

                $data2['sent_receive'] = 1;

                GroundHandling::where('id', $id)->update($data2);

                #print_r($user);exit;
                Session::flash('message', 'Ground Handling has been successfully stored');
            } catch (\Exception $e) {

                Session::flash('error', $e->getMessage());
                return redirect()->previous();
            }
            return redirect()->route('ground-handling');
    }


    public function image_upload($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {

            $img_name = ($_FILES['image']['name']);
            $random_number = rand(111, 999);

            $thumb_name = 'thumb_400x400_'.$random_number.'_'.$img_name;

            $newWidth=400;
            $targetFile=$destinationPath.$thumb_name;
            $originalFile=$image;

            $resizedImages 	= ImageResize::resize($newWidth, $targetFile,$originalFile);

            $thumb_image_destination=$destinationPath;
            $thumb_image_name=$thumb_name;

            //$rules = array('image' => 'required|mimes:png,jpeg,jpg');
            $rules = array('image' => 'required|mimes:'.$file_type_required);
            $validator = Validator::make(array('image' => $image), $rules);
            if ($validator->passes()) {
                // Files destination
                //$destinationPath = 'uploads/slider_image/';
                // Create folders if they don't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image_original_name = $image->getClientOriginalName();
                $image_name = rand(111, 999) . $image_original_name;
                $upload_success = $image->move($destinationPath, $image_name);

                $file=array($destinationPath . $image_name, $thumb_image_destination.$thumb_image_name);

                if ($upload_success) {
                    return $file_name = $file;
                }
                else{
                    return $file_name = '';
                }
            }
            else{
                return $file_name = '';
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GroundHandling::where('id',$id)->delete($id);
        Session::flash('message', 'Ground Handling has been successfully deleted');

        return redirect()->back();
    }

    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $ground_handling=GroundHandling::findOrFail($id);

        $user_id = Auth::user()->role_id;
        $signature = UserSignature::where('user_id',$user_id)->first();
        $data['signature'] = $signature->image;

        $image_path = public_path().'/assets/img/report.jpg';
        $image_path2 = public_path().'/assets/img/report_black.jpg';
        $img = '<img src="'.$image_path.'" height="150" width="300"  alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'" height="150" width="300"  alt="Surinam Airways" >';

        if($ground_handling->utc_local== 'utc'){$checked_utc='checked';}else{$checked_utc='';}
        if($ground_handling->utc_local== 'local'){$checked_local='checked';}else{$checked_local='';}

        if($ground_handling->packing_group== 'I'){$I='checked';}else{$I='';}
        if($ground_handling->packing_group== 'II'){$II='checked';}else{$II='';}
        if($ground_handling->packing_group== 'III'){$III='checked';}else{$III='';}


        if($ground_handling->class_7_category== 'I'){$cat1='checked';}else{$cat1='';}
        if($ground_handling->class_7_category== 'II'){$cat11='checked';}else{$cat11='';}
        if($ground_handling->class_7_category== 'III'){$cat111='checked';}else{$cat111='';}





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
                        <p style="font-weight: bolder; font-size:20px;" align="left">B              Operational Safety Report (OSR)</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">B.III OSR – GROUND HANDLING REPORT</span>
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
                    <th style="border-bottom: 2px solid; font-size: 20px; text-align: center;">Safety Department ref. nr : '.$ground_handling->reference_no.'</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">GROUND HANDLING REPORT</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-bordered table-responsive no-spacing tbl2">
                <tr>
                    <th style="text-align: center; background-color: yellow" colspan="4">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th colspan="4">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : '.$ground_handling->full_name.','.$ground_handling->email.','.$ground_handling->telephone.','.$ground_handling->extension.','.$ground_handling->fax.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="75%" style="border: 2px solid" colspan="3">2. LOCATION OF OCCURRENCE : '.$ground_handling->location_of_occurrence.'</th>
                    <th width="25%" style="border: 2px solid">3. RAMP CONDITION : '.$ground_handling->ramp_condition.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">4. DATE : '.date("M d, Y", strtotime($ground_handling->date)).'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">
                        5. TIME: '.$ground_handling->time.'&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="utc_local" value=""  '.$checked_utc.' style="display:inline;" > UTC
                        <input type="checkbox" name="utc_local" value="" '.$checked_local.' style="display:inline;" >  Local

                    </th>
                    <th width="25%" style="border: 2px solid">6. OPERATIONAL PHASE : '.$ground_handling->operational_phase.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">7. OPERATOR : '.$ground_handling->operator.'</th>
                    <th width="25%" style="border: 2px solid">8. FLIGHT NUMBER : '.$ground_handling->flight_number.'</th>
                    <th width="25%" style="border: 2px solid">9. AIRCRAFT TYPE : '.$ground_handling->aircraft_type.'</th>
                    <th width="25%" style="border: 2px solid">10. REGISTRATION : '.$ground_handling->registration.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">11. FROM : '.$ground_handling->from.'</th>
                    <th width="25%" style="border: 2px solid">12. TO : '.$ground_handling->to.'</th>
                    <th width="25%" style="border: 2px solid">13. DELAY (min) : '.$ground_handling->delay.'</th>
                    <th width="25%" style="border: 2px solid">14. DIVERSION : '.$ground_handling->diversion.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="4">15. THIRD PARTY INVOLVED (Contractor) '.$ground_handling->third_party_involved.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="4">16. DESCRIPTION OF OCCURRENCE ( add forms if necessary) <p>'.$ground_handling->description_of_occurrence.'</p></th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; ; background-color: yellow" colspan="4">DANGEROUS GOODS</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">17. ORIGIN OF THE GOODS : '.$ground_handling->origin_of_the_goods.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">18. IATA UN/ID : '.$ground_handling->iata_un_or_id.'</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">19. CLASS / DIVISION : '.$ground_handling->class_or_division.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">20. SUBSIDIARY RISK : '.$ground_handling->subsidiary_risk.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">
                        21. PACKING GROUP :
                        <input type="checkbox" name="packing_group" value=""  '.$I.' style="display:inline;" > I
                        <input type="checkbox" name="packing_group" value="" '.$II.' style="display:inline;" >  II
                        <input type="checkbox" name="packing_group" value="" '.$III.' style="display:inline;" >  III
                    </th>
                    <th width="50%" style="border: 2px solid" colspan="2">
                        22.CLASS 7 CATEGORY :
                        <input type="checkbox" name="class_7_category" value=""  '.$cat1.' style="display:inline;" > I
                        <input type="checkbox" name="class_7_category" value="" '.$cat11.' style="display:inline;" >  II
                        <input type="checkbox" name="class_7_category" value="" '.$cat111.' style="display:inline;" >  III
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">23. TYPE OF PACKING : '.$ground_handling->type_of_packing.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">24. PACKING SPEC. MARKING : '.$ground_handling->packing_spec_marking.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">25. NUMBER OF PACKAGES : '.$ground_handling->number_of_packages.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">26. QUANTITY-OF TRANSPORT INDEX : '.$ground_handling->quantity_of_transport_index.'</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">27.AIRWAY-BILL REFERENCE : '.$ground_handling->airway_bill_reference.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">28. COURIER POUCH /BAG TAG/ TKT REF : '.$ground_handling->courier_pouch_reference.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">29. SHIPPING AGENT : '.$ground_handling->shipping_agent.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">30. SHIPPING NAME : '.$ground_handling->shipping_name.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid; text-align: center; ; background-color: yellow" colspan="4">VEHICLE & RAMP EQUIPMENT DAMAGE</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">31. DAMAGE TO : '.$ground_handling->damage_to.'</th>
                    <th width="25%" style="border: 2px solid">32. DAMAGE BY : '.$ground_handling->damage_by.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">33. AREA (STAND) : '.$ground_handling->area.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="4">34.ENVIROMENTAL CONDITIONS (weather, surface, lighting) : '.$ground_handling->enviromental_condition.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="4">35. DETAILS OF DAMAGE (add forms if necessary) : '.$ground_handling->details_of_damage.'</th>
                </tr>





                <tr>
                    <th colspan="4">Please sent this information to the Safety Department at your earliest convenience but no later than 24 hours after the occurrence, via fax +597 430230 or via e-mail : safety@slm.firm.sr</th>
                </tr>
                <tr>
                    <th colspan="4">This form can also be submitted via the company website: www.flyslm.com
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

        $downloadfolder = public_path().'/pdf_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $output = $dompdf->output();
        file_put_contents($downloadfolder.'Ground_Handling_report.pdf', $output);

        $file = $downloadfolder.'/Ground_Handling_report.pdf';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'Ground_Handling_report.pdf', $headers);

    }
}