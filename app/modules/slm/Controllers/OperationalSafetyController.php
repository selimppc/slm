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

        $filename = "OperationalSafety.csv";
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
}