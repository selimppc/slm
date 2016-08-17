<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/4/16
 * Time: 10:27 AM
 */

namespace App\Modules\Slm\Controllers;

use App\Helpers\LogFileHelper;
use App\PdfManager;
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
use Validator;
use App\User;


class PdfManagerController extends Controller
{
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function index(){

        $pageTitle = 'Safety Bulletins';
        $title = Input::get('title');
        $year = Input::get('year');

        $role_id = Auth::user()->role_id;


        $data = PdfManager::where('pdf_type','bulletin')->where('title', 'LIKE', '%'.$title.'%')->where('year', 'LIKE', '%'.$year.'%')->paginate(30);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::pdf_manager.index',['data' => $data,'pageTitle'=>$pageTitle,'role_id'=>$role_id]);
    }

    public function index_alerts(){

        $pageTitle = 'Safety Alerts';
        $file_name = Input::get('file_name');

        $role_id = Auth::user()->role_id;


        $data = PdfManager::where('pdf_type','alerts')->where('file_name', 'LIKE', '%'.$file_name.'%')->paginate(30);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::pdf_alerts.index',['data' => $data,'pageTitle'=>$pageTitle,'role_id'=>$role_id]);
    }

    public function index_safety(){

        $pageTitle = 'Safety Manual';
        $file_name = Input::get('file_name');

        $role_id = Auth::user()->role_id;


        $data = PdfManager::where('pdf_type','safety')->where('file_name', 'LIKE', '%'.$file_name.'%')->paginate(30);
        //$data = Safety::get();
        //print_r($data);exit;

        return view('slm::pdf_safety.index',['data' => $data,'pageTitle'=>$pageTitle,'role_id'=>$role_id]);
    }

    public function pdf_add_info(){

        $pageTitle = 'Safety Bulletine Add Informations';

        return view('slm::pdf_manager._form',['pageTitle'=>$pageTitle]);
    }

    public function pdf_add_info_alert(){

        $pageTitle = 'Safety Alerts Add Informations';

        return view('slm::pdf_alerts._form',['pageTitle'=>$pageTitle]);
    }

    public function pdf_add_info_safety(){

        $pageTitle = 'Safety Manuals Add Informations';

        return view('slm::pdf_safety._form',['pageTitle'=>$pageTitle]);
    }

    public function store_pdf(Requests\PdfManagerRequest $request)
    {
        $input = $request->all();

        $files = Input::file('attchment');
        $file_count = count($files);

//print_r($input['pdf_type']);exit;

        if($files[0] != null) {

            foreach ($files as $file) {
                if (!empty($file)) {
                    $data = new PdfManager();

                    //$data->file_type
                    $file_type = $file->getMimeType();
                    $file_type = explode("/", $file_type);
                    $data->file_type = $file_type[0];
                    $data->file_size = $file->getSize();
                    $data->pdf_type = $input['pdf_type'];


                    /*$rules = array('file' => 'required|mimes:png,gif,jpeg,txt,pdf,doc,jpg,xlsx,xls,docx,pptx,ppt,pub');*/
                    $rules = array('file' => 'required|mimes:pdf');


                    $validator = Validator::make(array('file' => $file), $rules);

                    //print_r($validator->passes());exit;

                    if ($validator->passes()) {
                        // Files destination

                        $destinationPath = 'documents/';

                        $uploadfolder = 'documents/';

                        if (!file_exists($uploadfolder)) {
                            $oldmask = umask(0);  // helpful when used in linux server
                            mkdir($uploadfolder, 0777);
                        }


                        $file_original_name = $file->getClientOriginalName();

                        $file_name = rand(11111, 99999) . $file_original_name;
                        $upload_success = $file->move($destinationPath, $file_name);

                        $data->file_path = 'documents/' . $file_name;

                        $data->file_name = $file_original_name;

                        $org_title = explode(".pdf", $file_original_name);


                        if ($input['title'] == null) {
                            $data->title = $org_title[0];
                        } else {
                            $data->title = $input['title'];
                        }

                        $data->year = $input['year'];


                        //print_r($data);exit;

                        /* Transaction Start Here */
                        DB::beginTransaction();
                        try {

                            $data->save(); // store / update / code here

                            DB::commit();
                        } catch (Exception $e) {
                            //If there are any exceptions, rollback the transaction`
                            DB::rollback();
                            Session::flash('message', 'Successfully added!');
                        }
                    } else {
                        Session::flash('danger', 'Select only PDF file');
                    }
                }
            }
        }else{

            Session::flash('danger', 'Please Select only PDF file');

        }

        if(@$data->pdf_type == 'bulletin')
            return redirect()->route('safety-bulletin');
        if(@$data->pdf_type == 'alerts')
            return redirect()->route('alerts');
        if(@$data->pdf_type == 'safety')
            return redirect()->route('safety-manuals');
        else
            return redirect()->back();

    }

    public function show($id)
    {
        /*$pageTitle = 'View PDF Manager Informations';
        $data = PdfManager::where('id',$id)->first();
        return view('slm::pdf_manager.view', ['data' => $data, 'pageTitle'=> $pageTitle]);*/

        //$path = public_path().'/documents/51380Md.Nadimul-Haque.pdf';

        $data = PdfManager::where('id',$id)->first();

        //print_r($data['file_path']);exit;

        $filename = $data['file_path'];
        $path = public_path($filename);


        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

    public function edit($id)
    {
        $pageTitle = "Safety Bulletin Update Informations";
        $data = PdfManager::where('id',$id)->first();
        return view('slm::pdf_manager.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function edit_alert($id)
    {
        $pageTitle = "Safety Alerts Update Informations";
        $data = PdfManager::where('id',$id)->first();
        return view('slm::pdf_alerts.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function edit_safety($id)
    {
        $pageTitle = "Safety Manuals Update Informations";
        $data = PdfManager::where('id',$id)->first();
        return view('slm::pdf_safety.update',['pageTitle'=>$pageTitle,'data' => $data]);
    }

    public function update(Requests\PdfManagerRequest $request, $id)
    {

        $model = PdfManager::where('id', $id)->first();
        
        $input = $request->all();
        $files = Input::file('attchment');

        if($files[0] != null){
            $file_count = count($files);

            foreach ($files as $file) {
                if (!empty($file)) {
                    //$data = new PdfManager();



                    //$data->file_type
                    $file_type = $file->getMimeType();
                    $file_type = explode("/", $file_type);
                    //$data->file_type = $file_type[0];
                    //$data->file_size = $file->getSize();

                    $input['file_type'] = $file_type[0];
                    $input['file_size'] = $file->getSize();

                    /*$rules = array('file' => 'required|mimes:png,gif,jpeg,txt,pdf,doc,jpg,xlsx,xls,docx,pptx,ppt,pub');*/

                    $rules = array('file' => 'required|mimes:pdf');


                    $validator = Validator::make(array('file' => $file), $rules);
                    if ($validator->passes()) {
                        // Files destination
                        $destinationPath = 'documents/';

                        $uploadfolder = 'documents/';

                        if (!file_exists($uploadfolder)) {
                            $oldmask = umask(0);  // helpful when used in linux server
                            mkdir($uploadfolder, 0777);
                        }


                        $file_original_name = $file->getClientOriginalName();

                        $file_name = rand(11111, 99999) . $file_original_name;
                        $upload_success = $file->move($destinationPath, $file_name);

                        $input['file_path'] = 'documents/' . $file_name;
                        /*$model->file_path = $input['file_path'];
                        $model->save();
                        print_r($input['file_path']);exit;*/

                        $org_title = explode(".pdf",$file_original_name);


                        if($input['title']==null){
                            $model->title = $org_title[0];
                        }else{
                            $model->title = $input['title'];
                        }

                        @unlink(public_path()."/".$model->file_path);

                        $model->file_type = $input['file_type'];
                        $model->file_size = $input['file_size'];
                        $model->file_name = $file_original_name;
                        $model->file_path = $input['file_path'];
                        $model->pdf_type = $input['pdf_type'];



                        /* Transaction Start Here */
                        DB::beginTransaction();
                        try {

                            //$data->save(); // store / update / code here
                            $model->update($input);
                            DB::commit();
                            Session::flash('message', 'Successfully added!');
                        } catch (Exception $e) {
                            //If there are any exceptions, rollback the transaction`
                            DB::rollback();
                            Session::flash('danger', 'Upadete Failed');
                        }
                    } else {
                        Session::flash('danger', 'Select only PDF file');
                    }
                }
            }

        }
        else{

            $model->title = $input['title'];
            DB::beginTransaction();
            try {
                //$data->save(); // store / update / code here
                $model->update($input);
                DB::commit();
                Session::flash('message', 'Successfully Updated!');

            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', 'Upadete Failed');
            }

        }

        /*if(!empty($files)) {


        }else{exit(123);

        }*/

        if($model->pdf_type == 'bulletin')
            return redirect()->route('safety-bulletin');
        if($model->pdf_type == 'alerts')
            return redirect()->route('alerts');
        if($model->pdf_type == 'safety')
            return redirect()->route('safety-manuals');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model = PdfManager::where('id',$id)->first();
            if ($model->delete()) {
                unlink(public_path()."/".$model->file_path);
                DB::commit();
                Session::flash('message', 'Successfully deleted!');
                return redirect()->back();
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }
        return redirect()->route('pdf-manager');
    }

    public function destroy_files($id)
    {

        $model = PdfManager::where('id',$id)->first();
        unlink(public_path()."/".$model->file_path);
        Session::flash('message', 'Successfully deleted!');

    }



}