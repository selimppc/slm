<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 4:35 PM
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
use App\Modules\Slm\Models\GroundHandling;


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
                        $message->to($user->email);
                        //$message->to('shajjadhossain81@gmail.com');
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
        return view('slm::ground_handling.view',$data);
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

        GroundHandling::where('id',$id)->update($data);
        Session::flash('message', 'Ground Handling has been successfully updated');

        return redirect()->route('ground-handling');
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
}