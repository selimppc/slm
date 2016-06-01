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
}
