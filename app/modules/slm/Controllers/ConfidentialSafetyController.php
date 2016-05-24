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
use App\Modules\Slm\Models\ConfidentSafety;

use Dompdf\Dompdf;



class ConfidentialSafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Confidential Safety';
//        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data['confidential_safety'] = ConfidentSafety::paginate(10);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::confidential_safety.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle']='Add Confidential Safety';
        return view('slm::confidential_safety.create',$data);
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

        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
        //print_r($user);exit;


        if(ConfidentSafety::insert($data)) {

            try{
                Mail::send('slm::confidential_safety.mail_notification', array('model'=>$data),
                    function($message) use ($user)
                    {
//                        $message->from('bd.shawon1991@gmail.com', 'New Cabin Crew');
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        $message->to($user->email);
                        //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Confidential Safety added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Confidential safety has been successfully stored');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Does not Save!');
        }

        return redirect()->route('confidential-safety');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle']='Show Confidential Safety Details';
        $data['confidential_safety']=ConfidentSafety::findOrFail($id);
        return view('slm::confidential_safety.view',$data);
    }

    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = ConfidentSafety::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."ConfidentSafety.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'Name','Address','Email', 'Telephone', 'Function','Department','Aircraft Involved','Type of Operation','Weather','Flight Phase','Account of event'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {

            fputcsv($handle, array($row['name'], $row['address'],$row['email'], $row['telephone'], $row['function'], $row['department'], $row['aircraft_involved'],$row['type_of_operation'], $row['weather'],$row['flight_phase'],$row['account_of_event']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'ConfidentSafety.csv', $headers);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle']='Edit Confidential Safety Details';
        $data['confidential_safety']=ConfidentSafety::findOrFail($id);
        return view('slm::confidential_safety.edit',$data);
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

        ConfidentSafety::where('id',$id)->update($data);
        Session::flash('message', 'Confidential Safety has been successfully updated');

        return redirect()->route('confidential-safety');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ConfidentSafety::where('id',$id)->delete($id);
        Session::flash('message', 'Confidential Safety has been successfully deleted');

        return redirect()->back();
    }


    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $confidential_safety=ConfidentSafety::findOrFail($id);

        $image_path = public_path().'/assets/img/report.jpg';
        $image_path2 = public_path().'/assets/img/report_black.jpg';
        $img = '<img src="'.$image_path.'" height="150" width="300"  alt="Surinam Airways" >';
        $img2 = '<img src="'.$image_path2.'" height="150" width="300"  alt="Surinam Airways" >';

        $html = '

<style>
    .tbl {
        margin: 0px !important;
        border: 2px solid;
        width: 100%;
    }

    .tbl5 {

        border: 2px solid;
        border-top: 0px!important;
        border-left: 0px!important;
        border-right: 0px!important;
        width: 100%;
    }

    .tbl4 {
        margin: 0px !important;
        border: 2px solid;
        width: 100%;
    }

    .tbl6 {
        margin: 0px !important;
        border: 2px solid;
        width: 100%;
    }

    .tbl4 td{
        border: 2px solid;
    }

    .tbl4 th{
        border: 2px solid;
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
        padding:7px;
        text-align: left !important;
        }

    .report_img{
        height: 50px!important;
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

    .tbl6 td {
        text-align: left !important;
        vertical-align: top;

        }

    .tbl6 th {
    text-align: left !important;
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
                        <p style="font-weight: bolder; font-size:20px;" align="left">C Confidential Safety Report (CSR)</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">C. CONFIDENTIAL SAFETY REPORT</span>
            </table>
            <br>
            <br>
            <br>

            <table class="table table-bordered table-responsive tbl">
                <tr>
                    <th style="border-right: 2px solid" width="45%" class="report_img">
                        '.$img.'</th>
                    <th width="55%">
                        <p style="height: 40px; font-weight: bolder; font-size:35px;" align="center">Confidential Safety Report</p>
                    </th>
                </tr>
            </table>

            <table class="table table-bordered table-responsive tbl5">
                <tr>
                    <th width="100%">
                This voluntary report should be submitted to the Safety Department within 24 hours after the incident. FAX: +597-430230
This form can also be submitted via the company website: www.flyslm.com
                    </th>
                </tr>
            </table>

            <br>

            <table cellspacing="0" cellpadding="0" class="table table-bordered table-responsive tbl4">
                <tr>
                    <th width="20%">NAME</th>
                    <td width="80%">'.$confidential_safety->name.'</td>
                </tr>
                <tr>
                    <th>ADDRESS</th>
                    <td>'.$confidential_safety->address.'</td>
                </tr>
                <tr>
                    <th>E-MAIL</th>
                    <td>'.$confidential_safety->email.'</td>
                </tr>
                <tr>
                    <th>TEL #</th>
                    <td>'.$confidential_safety->telephone.'</td>
                </tr>
            </table>

            <br>
            <br>

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
                <li>Your personal details are required only to enable the Director of Safety to contact you for further
                    details about any part of your report</li>
                <li>This is a voluntary reporting method</li>
                <li>Entering your personal details is optional</li>
                <li>You will receive an acknowledgement as soon as possible</li>
            </ol>

            <br>
            <br>

            <table cellspacing="0" cellpadding="0"  class="table table-bordered table-responsive tbl6">
                <tr style="border: 2px solid">
                    <th width="30%" style="border: 2px solid">Function : '.$confidential_safety->function.'</th>
                    <th width="35%" style="border: 2px solid">Department : '.$confidential_safety->department.'</th>
                    <th width="35%" style="border: 2px solid">Aircraft Involved : '.$confidential_safety->aircraft_involved.'</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="30%" style="border: 2px solid">Type of Operation : '.$confidential_safety->type_of_operation.'</th>
                    <th width="35%" style="border: 2px solid">Weather : '.$confidential_safety->weather.'</th>
                    <th width="35%" style="border: 2px solid">Flight Phase : '.$confidential_safety->flight_phase.'</th>
                </tr>

                <tr>
                    <th colspan="3"><p>Account of event – (please continue on other side or attach additional sheets if necessary)</p></th>
                </tr>
                <tr>
                    <td colspan="3" height="300px">'.$confidential_safety->account_of_event.'</td>
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
        file_put_contents($downloadfolder.'Confidential_Safety_report.pdf', $output);

        $file = $downloadfolder.'/Confidential_Safety_report.pdf';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'Confidential_Safety_report.pdf', $headers);
    }
}
