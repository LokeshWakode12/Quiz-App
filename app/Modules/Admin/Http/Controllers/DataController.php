<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\User;
use App\Modules\Admin\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Modules\User\Models\Result;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;


class DataController extends Controller
{
    public function userdata()
    {
        $user = Session::get('admin');
        $userdata = User::where('trash',0)->get();
        return view("Admin::userdata",['data' => $userdata]);
    }

    public function Bin()
    {
        $userdata = User::where('trash',1)->get();
        return view("Admin::Bin",['data' => $userdata]);
    } 
    public function Trash($id)
    {
        $userdata = User::where('trash',0)->get();
        $user = User::find($id);
        $user->trash = 1;
        $user->update();
        return back();

    } 
    public function Restore($id)
    {
        $userdata = User::where('trash',1)->get();
        $user = User::find($id);
        $user->trash = 0;
        $user->update();
        return back();
    }
    public function Delete($id)
    {  
        $data = User::where('id',$id)->delete();
        return back();
    } 
    public function Update(Request $req){
        $user = User::where('id',$req->updateid)->get();
        $id = $req->status;
        $status = "UnBan";
        if($id == 1){
            $status = "Ban";
        }
        return view("Admin::update",['status'=>$status,'user'=> $user ]);
    }
    public function Insert(Request $req){
        $i = 0 ;
        if(strcmp($req->status,"Ban") == 0 ){
            $i = 1;
        }
        $user = User::find($req->updateid);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->status = $i;
        $user->save();
        return redirect("admin/userdata");
    }

    public function Graph(){
        
        $now = Carbon::now();
        $month = $now->month;
        $date = $now->format('d');

        // $users = Result::where( 'created_at', '=', Carbon::now())->get();
        $users = Result::all()->toArray();

        $data1 = Result::whereMonth('created_at', '=', $month)->count();
        $data2 = Result::all()->count();

        return view('Admin::statastics',['data1'=>$data1,'data2'=>$data2]);

    }
    
    public function importview() 
    {
        
        return view('Admin::importfile');
    }

    public function importque(Request $request) 
    {
        $validated = $request->validate([
            'myfile' => 'required|max:50000|mimes:xls,xlsx,csv',
        ]);
        
        $success = Excel::import(new UserImport, $request->file('myfile'),ExcelExcel::XLSX);
        if($success){
            return back()->withErrors('Questions Uploaded Successfully ');
        }
        return back()->withErrors(["msg" =>" not done"]);
       
    }
}
