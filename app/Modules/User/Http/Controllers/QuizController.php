<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Question;
use App\Modules\User\Models\Solution;
use App\Modules\User\Models\Result;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function startquiz(){

        $data = Question::inRandomOrder()->take(10)->get();
        $a = [];

        for($i=0; $i<count($data); $i++){

            $data1 = $data[$i]['id'];
            $data2 = $data[$i]['question'];
            $data3 = $data[$i]['option1'];
            $data4 = $data[$i]['option2'];
            $data5 = $data[$i]['option3'];
            $data6 = $data[$i]['option4'];

            $obj = ['id'=>$data1,
            'question'=>$data2, 
            'option1'=>$data3, 
            'option2'=>$data4, 
            'option3'=>$data5, 
            'option4'=>$data6 ];

            array_push($a,$obj);
        }
        
        $var = Str::random(32);
        Session::put('test_token', $var);
        return view('User::quizpanel',['data' => $a]);
    }

    public function datasend(Request $request){
        
        $qcount = count($request->que_id);

        for($i=1; $i <= $qcount; $i++)
        {
            $value = Question::where('id', $request->que_id[$i-1])->value('answer');
            $correct_ans = Question::where('id', $request->que_id[$i-1])->value($value);
        
            $score = 0 ;
            if(strcmp($request->user_ans[$i-1],$correct_ans) == 0 && !empty($request->user_ans[$i-1]) ){
                $score = 1 ;
            }

         Solution::insert([
                'user_id' => Session::get('userid'),
                'que_id' => $request->que_id[$i-1],
                'user_ans'=> $request->user_ans[$i-1],
                'score' => $score ,
                'correct_ans' => $correct_ans,
            ]);           
        }
        return response()->json(['success' => "successfull"]);
        
    }

    public function result(){

        $data = Solution::all();

        return view('User::result',['data'=>$data]);
    }
    
    public function endTest(Request $request){

            $test_token = Session::get('test_token');
            $user_id = Session::get('userid');
            $score = Solution::where('user_id',$user_id)->sum('score');
            $date = Carbon::now()->format('d-m-y');

            // dd($date);
            $result = new Result;
            $result->userid = $user_id;
            $result->test_token = $test_token;
            $result->score = $score;
            $result->date_test = $date;
            $result->save();
            Solution::where('user_id',$user_id)->delete();
            Session::pull('test_token');

            return redirect('/user/dashboard');
    }

    public function myresult(){
        $id = Session::get('userid');
        $data = Result::where('userid',$id)->get();
        return view('User::myresult',['data'=>$data]);
        
    }
}