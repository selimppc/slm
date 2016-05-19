<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/16
 * Time: 9:35 AM
 */

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Slm\Models\Safety;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Helpers\Notification;


class NotificationController extends Controller
{
    public function update_safety(){

        /*$model = Safety::where('notified_no',0)->get();
        $input = [
            'notified_no' => 1
        ];
        print_r($model);exit;*/

        DB::beginTransaction();
        try {
            DB::table('air_safety')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            /*$model->update($input);*/
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
            //LogFileHelper::log_info('update-role', 'Successfully updated.', ['Role title: '.$input['title']]);
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            //LogFileHelper::log_error('update-role', $e->getMessage(), ['Role title: '.$input['title']]);
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        /*return redirect()->route('air-safety');*/
        return redirect()->back();
    }


    public function update_cabin(){

        DB::beginTransaction();
        try {
            DB::table('cabin_crew')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        return redirect()->back();
    }

    public function update_confidential(){

        DB::beginTransaction();
        try {
            DB::table('confident_safety')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        return redirect()->back();
    }

    public function update_dangerous(){

        DB::beginTransaction();
        try {
            DB::table('operational_safety')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        return redirect()->back();
    }

    public function update_ground(){

        DB::beginTransaction();
        try {
            DB::table('ground_handling')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        return redirect()->back();
    }

    public function update_maintenance(){

        DB::beginTransaction();
        try {
            DB::table('maintenance_occurrence')->where('notified_no', '=', 0)->update(array('notified_no' => 1));
            DB::commit();
            Session::flash('message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $notify_data = Notification::notify_data();
        Session::forget('notify_data');
        Session::put('notify_data', $notify_data);

        return redirect()->back();
    }

}