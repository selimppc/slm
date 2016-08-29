<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 3/2/16
 * Time: 4:25 PM
 */

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\UserActivity;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use App\RoleUser;
use App\User;
use App\Role;

class UserActivityController extends Controller
{


    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }


    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "User Activity ";

        $data = UserActivity::with('relUser')->orderBy('id', 'DESC')->paginate(30);
        $user_list = User::lists('username', 'id');

        return view('user::user_activity.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'user_list'=> $user_list,
        ]);
    }



    public function search_user_activity(){
        $pageTitle = "User Activity by";
        $data = new UserActivity();

        if($this->isGetRequest()){
            $action_name = Input::get('action_name');
            $action_route = Input::get('action_route');
            $in_date = Input::get('date');
            $user_id = Input::get('user_id');

            $data = $data->select('user_activity.*');
            if($action_name){
                $data = $data->where('user_activity.action_name', 'LIKE','%'.$action_name.'%');
            }
            if($action_route){
                $data = $data->where('user_activity.action_url', 'LIKE', '%'.$action_route.'%');
            }
            if($in_date){
                $data = $data->whereDate('user_activity.date', '=', $in_date);
            }
            if(isset($user_id) && !empty($user_id)){
                $data = $data->where('user_activity.user_id', '=', $user_id);
            }

            $data = $data->orderBy('user_activity.id', 'DESC')->paginate(30);
            /*$data = $data->orderBy('user_activity.id', 'DESC')->toSql();
            dd($data); exit;*/
        }else{
            $data = UserActivity::with('relUser')->orderBy('id', 'DESC')->paginate(30);
        }

        $user_list = User::lists('username', 'id');

        return view('user::user_activity.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'user_list'=> $user_list,

        ]);
    }


}