<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {
        return view("Admin::welcome");
    }

    public function admin_login(Request $req){

        $validator = Validator::make($req->all(),[
            'email' => 'required|email|exists:admin',
            'password' => [
                'required',
                'min:5',
                
            ]
        ]);

        $admin =  Admin::where(['email'=>$req->email])->first();
        $adminid = Admin::where(['email'=>$req->email])->value('id');

        if($validator->passes()){
            if(!$admin || !Hash::check($req->password,$admin->password)){
                return response()->json(['notexists' => "Username and password does not matched"]);
            }else{
                 Session::put('admin_id', $adminid);
                 $sess = Session::get('admin_id');
                return response()->json(['success' =>  "Sucessfully login" ]);
            }
            
        }else{ 
                return response()->json(['error' => $validator->errors()]);
        }

    }

    public function admin_register(Request $req){

        $validator = Validator::make($req->all(),[
            'name' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:5',
                'max:15',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            ],
            'newpassword' => [
                'required',
                'min:5',
                'max:15',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
                'same:password',
            ],
        ]);

        $admin = Admin::where('email',$req['email'])->first();
        
        if($validator->passes()){
            if($admin){
                return response()->json(['exists' => "User already Exists" ]);
            }
            else{
                $admin = new Admin;
                $admin->name = $req['name'];
                $admin->email=$req['email'];
                $admin->password = Hash::make($req['password']);
                $admin->save();
                return response()->json(['success'=> 'User Registered sucessfully']);
            }
        }
        else{  
                return response()->json(['error' => $validator->errors() ]);
        }
    }

    public function admindashboard(){
        $id = Session::get('admin_id');
        $data = Admin::where('id',$id)->value('name');
        return view('Admin::admindashboard',['data'=>$data]);
    }

    public function myInfo(Request $request){
        $id = Session::get('admin_id');
        $data = Admin::where('id',$id)->get();
        if(strcmp($request->path(),"admin/myinfoview")==0){
            return view("Admin::myInfo",['data'=>$data[0]->toArray()]);
        }else{
            return view("Admin::updatemyinfo",['data'=>$data[0]->toArray()]);
        }

    }

    public function changeinfo(Request $request){

        $id = Session::get('admin_id');
        $data = Admin::find($id);
        $data->name = $request->name; 
        $data->email = $request->email; 
        if(!empty($request->password)){
        $data->password = Hash::make($request->password); 
        }
        $data->update();

        return redirect("/admin/dashboard");

    }
    
}
