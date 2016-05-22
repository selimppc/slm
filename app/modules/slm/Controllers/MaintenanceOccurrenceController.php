<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/11/16
 * Time: 1:02 PM
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
use App\Modules\Slm\Models\MaintenanceOccurrence;

use Dompdf\Dompdf;

class MaintenanceOccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Maintenance Occurrence';
//        $full_name = Input::get('full_name');
        //$data = new Safety();
        $data['maintenance_occurrence'] = MaintenanceOccurrence::paginate(10);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::maintenance_occurrence.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle']='Add Maintenance Occurrence';
        return view('slm::maintenance_occurrence.create',$data);
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

        $user = DB::table('user')->where('username', '=', 'super-admin')->first();
        $token = $user->csrf_token;
//        print_r($data);exit;
//        MaintenanceOccurrence::find(1);exit;
        if(MaintenanceOccurrence::insert($data)) {

            try{
                Mail::send('slm::maintenance_occurrence.mail_notification', array('maintenance_occurrence'=>$data),
                    function($message) use ($user)
                    {
                        $message->from('devdhaka405@gmail.com', 'SLM');
                        $message->to($user->email);
                        //$message->to('shajjadhossain81@gmail.com');
//                        $message->replyTo('devdhaka405@gmail.com','New Air Safety Data Added');
                        $message->subject('New Maintenance Occurrence added');
                    });

                #print_r($user);exit;
                Session::flash('message', 'Maintenance Occurrence has been successfully stored');
            }catch (\Exception $e){

                Session::flash('error', $e->getMessage());
            }
        }else{
            Session::flash('error', 'Does not Save!');
        }

        return redirect()->route('maintenance-occurrence');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle']='Show Maintenance Occurrence Details';
        $data['maintenance_occurrence']=MaintenanceOccurrence::findOrFail($id);
        return view('slm::maintenance_occurrence.view',$data);
    }

    public function csv(){

        //$table = Safety::where('id',$id)->first();
        $table = MaintenanceOccurrence::all();

        //print_r($table['full_name']);exit;

        $downloadfolder = 'csv_files/';

        if ( !file_exists($downloadfolder) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($downloadfolder, 0777);
        }

        $filename = $downloadfolder."MaintenanceOccurrence.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'NAME','EMAIL', 'TELEPHONE', 'EXTENSION','FAX','DATE OF OCCURRENCE','TIME OF OCCURRENCE','SHIFT','LOCATION OF OCCURRENCE','SUB LOCATION','MANDATORY','AIRCRAFT TYPE','REGISTRATION','OPERATOR','ETOPS','TECHNICAL LOG REF','TAG/DEMAND NO','COMPONENT','PART NUMBER','SERIAL NUMBER','QUARANTINED','ATA CODE','ATA SUB CODE','TITLE OF OCCURRENCE','DESCRIPTION OF OCCURRENCE'));

        //fputcsv($handle, array($table['full_name'], $table['email'], $table['telephone'], $table['extension']));

        foreach($table as $row) {

            fputcsv($handle, array($row['full_name'], $row['email'], $row['telephone'], $row['extension'], $row['fax'],$row['date_of_occurrence'],$row['time_of_occurrence'], $row['shift'],$row['location_of_occurrence'], $row['sub_location_of_occurrence'],$row['mandatory'], $row['aircraft_type'],$row['registration'],$row['operator'], $row['etops'], $row['technical_log_ref'], $row['tag_or_demand_no'],$row['component'], $row['part_number'],$row['serial_number'],  $row['quarantined'],$row['ata_code'], $row['ata_sub_code'],$row['title_of_occurrence'], $row['description_of_occurrence']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        //return Response::download($handle, 'tweets.csv', $headers);
        return Response::download($filename, 'MaintenanceOccurrence.csv', $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle']='Edit Maintenance Occurrence Details';
        $data['maintenance_occurrence']=MaintenanceOccurrence::findOrFail($id);

        $data['maintenance_occurrence']['date_of_occurrence']=date("M d, Y", strtotime($data['maintenance_occurrence']['date_of_occurrence']));

        return view('slm::maintenance_occurrence.edit',$data);
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

        MaintenanceOccurrence::where('id',$id)->update($data);
        Session::flash('message', 'Maintenance Occurrence has been successfully updated');

        return redirect()->route('maintenance-occurrence');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MaintenanceOccurrence::where('id',$id)->delete($id);
        Session::flash('message', 'Maintenance Occurrence has been successfully deleted');

        return redirect()->back();
    }

    public function create_pdf($id){

        /*$html = "<table border='1'>
            <tr>
                <td>shajjad</td>
                <td>hossain</td>
            </tr>
        </table>";*/

        $maintenance_occurrence=MaintenanceOccurrence::findOrFail($id);

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
                        <p style="font-weight: bolder; font-size:20px;" align="left">B              Operational Safety Report (OSR)</p>
                    </th>

                </tr>
                <span style="font-weight: bolder; font-size:20px;">B.IV OSR – MAINTENANCE OCCURRENCE REPORT</span>
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
                    <th style="border-bottom: 2px solid; font-size: 20px; text-align: center;">SAFETY DEPARTMENT REF.NR:</th>
                </tr>
                <tr>
                    <th style="text-align: center; color:red; font-size: 35px; font-weight: bold">MAINTENANCE OCCURRENCE REPORT</th>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-bordered table-responsive no-spacing tbl2">
                <tr>
                    <th style="text-align: center; background-color: yellow" colspan="7">GENERAL INFORMATION</th>
                </tr>
                <tr>
                    <th colspan="7">1. FULL NAME AND CONTACT INFORMATION - (tel, extension, fax, e-mail) : '.$maintenance_occurrence->full_name.','.$maintenance_occurrence->email.','.$maintenance_occurrence->telephone.','.$maintenance_occurrence->extension.','.$maintenance_occurrence->fax.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="28%" style="border: 2px solid" colspan="2">2. DATE OF OCCURRENCE :
                        '.date("M d, Y", strtotime($maintenance_occurrence->date_of_occurrence)).'
                    </th>
                    <th width="14%" style="border: 2px solid">3. TIME OF OCCURRENCE : '.$maintenance_occurrence->time_of_occurrence.'</th>
                    <th width="14%" style="border: 2px solid">4. SHIFT : '.$maintenance_occurrence->shift.'</th>
                    <th width="14%" style="border: 2px solid">5. LOCATION OF OCCURRENCE : '.$maintenance_occurrence->location_of_occurrence.'</th>
                    <th width="30%" style="border: 2px solid" colspan="2">6. SUB LOCATION : '.$maintenance_occurrence->sub_location_of_occurrence.'</th>
                </tr>

                <tr style="border: 2px solid">
                    <th width="14%" style="border: 2px solid">7. MANDATORY : '.$maintenance_occurrence->mandatory.'</th>
                    <th width="14%" style="border: 2px solid">8. AIRCRAFT TYPE : '.$maintenance_occurrence->aircraft_type.'</th>
                    <th width="14%" style="border: 2px solid">9. REGISTRATION : '.$maintenance_occurrence->registration.'</th>
                    <th width="14%" style="border: 2px solid">10. OPERATOR : '.$maintenance_occurrence->operator.'</th>
                    <th width="14%" style="border: 2px solid">11. ETOPS : '.$maintenance_occurrence->etops.'</th>
                    <th width="14%" style="border: 2px solid">12. TECHNICAL LOG REF : '.$maintenance_occurrence->technical_log_ref.'</th>
                    <th width="16%" style="border: 2px solid">13. TAG/DEMAND NO : '.$maintenance_occurrence->tag_or_demand_no.'</th>
                </tr>
                <tr style="border: 2px solid">
                    <th width="28%" style="border: 2px solid" colspan="2">14. COMPONENT : '.$maintenance_occurrence->component.'</th>
                    <th width="14%" style="border: 2px solid">15. PART NUMBER : '.$maintenance_occurrence->part_number.'</th>
                    <th width="14%" style="border: 2px solid">16. SERIAL NUMBER : '.$maintenance_occurrence->serial_number.'</th>
                    <th width="14%" style="border: 2px solid">17. QUARANTINED : '.$maintenance_occurrence->quarantined.'</th>
                    <th width="14%" style="border: 2px solid">18. ATA CODE : '.$maintenance_occurrence->ata_code.'</th>
                    <th width="16%" style="border: 2px solid">19. ATA SUB CODE : '.$maintenance_occurrence->ata_sub_code.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">20. TITLE OF OCCURRENCE : '.$maintenance_occurrence->title_of_occurrence.'</th>
                </tr>
                <tr>
                    <th width="100%" style="border: 2px solid" colspan="7">21. DESCRIPTION OF OCCURRENCE : <p>'.$maintenance_occurrence->description_of_occurrence.'</p></th>
                </tr>

                <tr>
                    <th colspan="7">Please sent this information to the Safety Department at your earliest convenience but no later than 24 hours after the occurrence, via fax +597 430230 or via e-mail : safety@slm.firm.sr</th>
                </tr>
                <tr>
                    <th colspan="7">This form can also be submitted via the company website: www.flyslm.com
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