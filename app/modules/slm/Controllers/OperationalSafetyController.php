<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 8:59 AM
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
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Modules\Slm\Models\OperationalSafety;

use Dompdf\Dompdf;

class OperationalSafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Operational Safety';
//        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data['operational_safety'] = OperationalSafety::paginate(10);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::operational_safety.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle']='Add Operational Safety';
        return view('slm::operational_safety.create',$data);
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

        $data['date_of_occurrence']=date("Y-m-d", strtotime($data['date_of_occurrence']));
        $data['date_of_signature']=date("Y-m-d", strtotime($data['date_of_signature']));
        $data['flight_date']=date("Y-m-d", strtotime($data['flight_date']));

        $file=Input::file('signature');
        if(isset($file)){
            $rules = array('file' => 'mimes:jpeg,jpg,png,gif|max:100');
            $validator = Validator::make(array('file' => $file), $rules);
            //print_r($validator->passes());exit;

            if ($validator->passes()) {
                $upload_folder = 'signature/';
                if (!file_exists($upload_folder)) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir($upload_folder, 0777);
                }


                $file_original_name = $file->getClientOriginalName();

                $file_name = rand(11111, 99999) . $file_original_name;
                $file->move($upload_folder, $file_name);
                $signature=$upload_folder.$file_name;
                $data['signature']=$signature;

            }else{
                // Redirect or return json to frontend with a helpful message to inform the user
                // that the provided file was not an adequate type
                return redirect('add-operational-safety')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

//        dd($data);
        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
        //print_r($user);exit;


        if(OperationalSafety::insert($data)) {

            try{
                Mail::send('slm::operational_safety.mail_notification', array('model'=>$data),
                    function($message) use ($user)
                    {
//                        $message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        $message->to($user->email);
                        //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Operational Safety added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Operational safety has been successfully stored');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Does not Save!');
        }

        return redirect()->route('operational-safety');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle']='Show Operational Safety Details';
        $data['operational_safety']=OperationalSafety::findOrFail($id);
        return view('slm::operational_safety.view',$data);
    }


    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = OperationalSafety::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."OperationalSafety.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'Mark type of Occurrence','Operator', 'Date of Occurrence', 'Local time of Occurrence','Flight date','Flight no','Departure airport','Destination airport','Aircraft type','Aircraft registration','Location of occurrence','Origin of the goods','Description of the occurrence including details of injury, damage, etc','Proper shipping name (including the technical name)','UN/ID no (when known)','Class/division (when known)','Subsidiary risk(s)','Packing group','Category, (class 7 only)','Type of packaging','Packaging specification marking','No. of packages','Quantity (or transport index. If applicable','Reference no. of Airway bill','Reference no. of courier pouch, baggage tag, or passenger ticket','Name and address of shipper, agent, passenger, etc','Other relevant information (including suspected cause, any action taken)','Name and title of person making report','Telephone no','Company dept. code, E-mail or Info Mail code','Reporter ref','Address','Date / Signature','Description of the occurrence (continuation)'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {
            fputcsv($handle, array($row['type_of_occurrence'], $row['operator'], $row['date_of_occurrence'], $row['local_time_of_occurrence'],$row['flight_date'], $row['flight_no'],$row['departure_airport'], $row['destination_airport'],$row['aircraft_type'], $row['aircraft_registration'], $row['location_of_occurrence'], $row['origin_of_the_goods'],$row['description_of_the_occurrence'],$row['proper_shipping_name'], $row['un_or_id_no'], $row['class_or_division'], $row['subsidiary_risks'], $row['packing_group'], $row['category'], $row['type_of_packaging'], $row['packaging_specification_marking'], $row['no_of_packages'], $row['quantity'], $row['reference_no_of_airway_bill'], $row['reference_no_of_courier'], $row['name_and_address_of_shipper_agent_passenger'], $row['other_relevant_information'],$row['name_and_title_of_person_making_report'], $row['telephone_no'],$row['company_contact'],$row['reporter_ref'],$row['address'],$row['date_of_signature'],$row['description_of_the_occurrence']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'OperationalSafety.csv', $headers);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle']='Edit Operational Safety Details';
        $data['operational_safety']=OperationalSafety::findOrFail($id);

        $data['operational_safety']['date_of_occurrence']=date("M d, Y", strtotime($data['operational_safety']['date_of_occurrence']));
        $data['operational_safety']['date_of_signature']=date("M d, Y", strtotime($data['operational_safety']['date_of_signature']));
        $data['operational_safety']['flight_date']=date("M d, Y", strtotime($data['operational_safety']['flight_date']));

        return view('slm::operational_safety.edit',$data);
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

        $data['date_of_occurrence']=date("Y-m-d", strtotime($data['date_of_occurrence']));
        $data['date_of_signature']=date("Y-m-d", strtotime($data['date_of_signature']));
        $data['flight_date']=date("Y-m-d", strtotime($data['flight_date']));

        $file=Input::file('signature');
        if(isset($file)){
            $rules = array('file' => 'mimes:jpeg,jpg,png,gif|max:100');
            $validator = Validator::make(array('file' => $file), $rules);
            //print_r($validator->passes());exit;

            if ($validator->passes()) {
                $upload_folder = 'signature/';
                if (!file_exists($upload_folder)) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir($upload_folder, 0777);
                }

                $file_original_name = $file->getClientOriginalName();

                $file_name = rand(11111, 99999) . $file_original_name;
                $file->move($upload_folder, $file_name);
                $signature=$upload_folder.$file_name;
                $existing_file=OperationalSafety::select('signature')->where('id',$id)->first();
                if(isset($existing_file->signature) && !empty($existing_file->signature))
                {
//                    $kk=public_path($existing_file->signature);
//                    echo $kk;exit;
                    unlink($existing_file->signature);
                }
                $data['signature']=$signature;

            }else{
                // Redirect or return json to frontend with a helpful message to inform the user
                // that the provided file was not an adequate type
                return redirect('edit-operational-safety')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        OperationalSafety::where('id',$id)->update($data);
        Session::flash('message', 'Operational Safety has been successfully updated');

        return redirect()->route('operational-safety');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_file=OperationalSafety::select('signature')->where('id',$id)->first();
        if(isset($existing_file->signature) && !empty($existing_file->signature))
        {
            unlink($existing_file->signature);
        }
        OperationalSafety::where('id',$id)->delete($id);
        Session::flash('message', 'Operational Safety has been successfully deleted');

        return redirect()->back();
    }

    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $operational_safety=OperationalSafety::findOrFail($id);

        $image_path = public_path().'/assets/img/report.jpg';
        $image_path2 = public_path().'/assets/img/report_black.jpg';
        $img = '<img src="'.$image_path.'" height="150" width="300"  alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'" height="150" width="300"  alt="Surinam Airways" >';

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
                        <p style="font-weight: bolder; font-size:20px;" align="left">B Operational Safety Report</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">B.V OSR- DANGEROUS GOODS OCCURRENCE REPORT (Figure 9.6.A)</span>
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
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">Dangerous Goods Occurrence Report</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-bordered table-responsive no-spacing tbl2">
                <tr>
                    <th style="text-align: center; background-color: yellow" colspan="4">GENERAL INFORMATION</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">
                        Mark type of Occurrence : '.$operational_safety->type_of_occurrence.'
                    </th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">1. Operator : '.$operational_safety->operator.'</th>
                    <th width="25%" style="border: 2px solid">2. Date of Occurrence : '.date("M d, Y", strtotime($operational_safety->date_of_occurrence)).'</th>
                    <th width="25%" style="border: 2px solid">3. Local time of Occurrence : '.$operational_safety->local_time_of_occurrence.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">4. Flight date : '.date("M d, Y", strtotime($operational_safety->flight_date)).'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">5. Flight no: : '.$operational_safety->flight_no.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">6. Departure airport : '.$operational_safety->departure_airport.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">7. Destination airport : '.$operational_safety->destination_airport.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">8. Aircraft type : '.$operational_safety->aircraft_type.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">9. Aircraft registration : '.$operational_safety->aircraft_registration.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">10. Location of occurrence : '.$operational_safety->location_of_occurrence.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">11. Origin of the goods : '.$operational_safety->origin_of_the_goods.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">12. Description of the occurrence including details of injury, damage, etc.(if necessary continue on the next page) : '.$operational_safety->description_of_the_occurrence.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">13. Proper shipping name (including the technical name) : '.$operational_safety->proper_shipping_name.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">14. UN/ID no (when known) : '.$operational_safety->un_or_id_no.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">15. Class/division (when known) : '.$operational_safety->class_or_division.'</th>
                    <th width="25%" style="border: 2px solid">16. Subsidiary risk(s) : '.$operational_safety->subsidiary_risks.'</th>
                    <th width="25%" style="border: 2px solid">17. Packing group : '.$operational_safety->packing_group.'</th>
                    <th width="25%" style="border: 2px solid">18. Category, (class 7 only) : '.$operational_safety->category.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="25%" style="border: 2px solid">19. Type of packaging : '.$operational_safety->type_of_packaging.'</th>
                    <th width="25%" style="border: 2px solid">20 Packaging specification marking : '.$operational_safety->packaging_specification_marking.'</th>
                    <th width="25%" style="border: 2px solid">21. No. of packages : '.$operational_safety->no_of_packages.'</th>
                    <th width="25%" style="border: 2px solid">22. Quantity (or transport index. If applicable : '.$operational_safety->quantity.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">23. Reference no. of Airway bill : '.$operational_safety->reference_no_of_airway_bill.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">24. Reference no. of courier pouch, baggage tag, or passenger ticket : '.$operational_safety->reference_no_of_courier.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">25. Name and address of shipper, agent, passenger, etc. : '.$operational_safety->name_and_address_of_shipper_agent_passenger.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">26. Other relevant information (including suspected cause, any action taken) : '.$operational_safety->other_relevant_information.'</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">27. Name and title of person making report : '.$operational_safety->name_and_title_of_person_making_report.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">28. Telephone no. : '.$operational_safety->telephone_no.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">29. Company dept. code, E-mail or Info Mail code : '.$operational_safety->company_contact.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">30. Reporter ref : '.$operational_safety->reporter_ref.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="50%" style="border: 2px solid" colspan="2">31. Address : '.$operational_safety->address.'</th>
                    <th width="50%" style="border: 2px solid" colspan="2">32. Date / Signature : '.date("M d, Y", strtotime($operational_safety->date_of_signature)).'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="100%" style="border: 2px solid" colspan="4">33. Description of the occurrence (continuation) : '.$operational_safety->description_of_the_occurrence.'</th>
                </tr>
            </table>
            <style>
                /*.border-double { border: 5px double #293a4a}*/
                .style_ol {
                    border: 1px solid #000000 !important;
                }
                .style_ol li {
                    padding: 2px;
                    line-height: 20px;
                }
            </style>
            <ol class="style_ol">
                <p style="text-align: left"><b>Note:</b></p>
                <li>Any type of dangerous goods occurrence must be reported, irrespective of whether the dangerous good are
                    contained in cargo, mail or baggage.</li>
                <li>A dangerous goods accident is an occurrence associated with and related to the transport of dangerous goods
                    which result in fatal or serious injury to a person or major property damage. For this purpose, serious injury is an
                    injury which is sustained by a person in an accident and which: (a) requires hospitalization for more than 48 hours,
                    commencing from the time the injury was received;(b) result in a fracture of any bones (except small fractures of
                    fingers, toes or nose) ;(c) involves lacerations which cause severe haemorrhage, nerve, muscle or tendon damage;
                    (d) involves injury to any internal organ; (e) involves second or third degree burns; or any burns affecting more than
                    5% of the body surface; or (f) involves verified exposure to infectious substances or injurious radiation. A dangerous
                    goods accident may also be an aircraft accident; in which case the normal procedure for dangerous goods accidents
                    must be followed.</li>
                <li>A dangerous goods incident is an occurrence, other than a dangerous goods accident, associated with and related
                    to the transport of dangerous goods, not necessarily occurring on board an aircraft, which results in injury to a
                    person, property damage, fire ,breakage ,spillage ,leakage of fluid or radiation or other evidence that the integrity of
                    the packing has not been maintained. Any occurrence relating to the transport of dangerous goods which seriously
                    jeopardizes the aircraft or its occupants is also deemed to constitute a dangerous goods incident.</li>
                <li>This form may also be used to report any occasion when undeclared or misdeclared dangerous goods are
                    discovered in cargo or when baggage contains dangerous goods which passengers are not permitted to take on
                    board aircraft.</li>
                <li>An initial report should be dispatched within 72 hours of the occurrence, unless exceptional circumstances prevent
                    this. The initial report may be made by any means but a written report should be sent as soon as possible, even if all
                    the information is not available.</li>
                <li>Completed reports are normally sent to the competent authority.</li>
                <li>Copies of all relevant documents should be included with the report.</li>
                <li>Providing it is safe to do so, all dangerous goods, packaging’s, documents etc. relating to the occurrence must be
                    retained until after the initial report has been made.</li>
                <li>Requirements and procedures differ from state to state, it is recommended that the local competent authority be
                    contacted in order to clarify the exact procedures to be followed in the event of a dangerous goods incident or
                    accident.</li>
            </ol>
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