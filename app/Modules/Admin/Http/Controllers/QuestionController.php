<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Question;
use Illuminate\Support\Facades\Validator;
use App\Modules\Admin\Http\Controllers\Questions;
use Illuminate\Support\Facades\Session;
use App\Modules\User\Models\Result;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    function storequestion(Request $req){

        $validator = Validator::make($req->all(),[
            'Question' => 'required|min:5',
            'Option1' => 'required',
            'Option2' => 'required',
            'Option3' => 'required',
            'Option4' => 'required',
        ]);

        
        if($validator->passes()){
                $user = new Question;
                $user->question = $req['Question'];
                $user->category = $req['category'];
                $user->Option1 = $req['Option1'];
                $user->Option2 = $req['Option2'];
                $user->Option3 = $req['Option3'];
                $user->Option4 = $req['Option4'];
                $user->Answer = $req['Answer'];
                $user->save();
                return response()->json(['success'=> 'Question Add sucessfully']);
        }
        else{
            return response()->json(['error' => $validator->errors() ]);    
        }
    }

    function easyquestions(){

        $data = Question::where('category',"easy")->get();
        return view("Admin::easyquestions",['data' => $data ]);
    }

    function mediumquestions(){

        $data = Question::where('category',"medium")->get();
        return view("Admin::easyquestions",['data' => $data ]);
    }
    function hardquestions(){

        $data = Question::where('category',"hard")->get();
        return view("Admin::easyquestions",['data' => $data ]);
    }

    function deleteque($id){

        $data = Question::where('id',$id)->delete();
        return back();
    }

    function updateque(Request $req){
        $data = Question::where('id',$req->updateid)->get();
        return view("Admin::updateque",['data'=>$data]);
    }

    function insertque(Request $req){

        $user = Question::find($req->id);
        $user->question = $req->name;
        $user->option1 = $req->option1;
        $user->option2 = $req->option2;
        $user->option3 = $req->option3;
        $user->option4 = $req->option4;
        $user->category = $req->category;
        $user->answer = $req->Answer;
        $user->save();

        return redirect("/admin/dashboard");
    }

    function resultall(){
        $data1 = DB::table('results')
        ->join('users','results.userid','=','users.id')
        ->get();
        // dd($data1);
        
        return view("Admin::resultall",['data1'=> $data1]);
    }

    function deleteres($id){
        $data = Result::where('test_token',$id)->delete();

        return back();
    }
}
