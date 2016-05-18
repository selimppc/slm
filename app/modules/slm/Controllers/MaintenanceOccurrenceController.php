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
}