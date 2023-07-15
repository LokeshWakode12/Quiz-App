<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Str;
use Carbon\Carbon;


class UserController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("User::welcome");
    }

    public function user_login(Request $req){

        $validator = Validator::make($req->all(),[
            'email' => 'required|email',
            'password' => [
                'required',
                'min:5',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            ]
        ]);

        $user =  User::where(['email'=>$req->email])->first();
        $userId = User::where(['email'=>$req->email])->value('id');
        $status = User::where(['email'=>$req->email])->value('status');
    
        if($validator->passes()){
            if(!$user || !Hash::check($req->password,$user->password)){
                return response()->json(['notexists' => "Username and password does not matched"]);
            }else{
                if($status == 1){
                    return response()->json(['notexists' => "You are Banned"]);
                }
                else{
                    $req->session()->put('userid',$userId);
                    return response()->json(['success' => 'Sucessfully Logged In']);
                }
            }
            
        }else{ 
                return response()->json(['error' => $validator->errors()]);
        }

    }

    public function user_register(Request $req){

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

        $user = User::where('email',$req['email'])->first();
        
        if($validator->passes()){
            if($user){
                return response()->json(['exists' => "User already Exists" ]);
            }
            else{
                $user = new User;
                $user->name = $req['name'];
                $user->email=$req['email'];
                $user->password = Hash::make($req['password']);
                $user->save();
                return response()->json(['success'=> 'User Registered sucessfully']);
            }
        }
        else{  
                return response()->json(['error' => $validator->errors() ]);
        }
    }

    public function userdashboard(){
        $id = Session::get('userid');
        $data = User::where('id',$id)->value('name');
        return view("User::userdashboard",['data'=>$data]);
    }


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>forget password>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


    public function forget_view()
          {
            return view("User::forgetpwd");
          }

    function forget_link(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        $user = User::where('email',$request['email'])->first();
        
        if($validator->passes()){
            if($user){

                $token = str::random(40);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'expire_at'=>Carbon::now()->addMinutes(10)->toDateTimeString()
                    ]);
            
                    $action_link = route('password-reset', ['token'=>$token, 'email'=>$request->email]);

                $body="You can reset your password by clicking the link below.";

                Mail::send('User::email-forget', ['action_link'=> $action_link, 'body'=> $body], 
                    function($message) use($request){
                        $message->from('abhishektiwari@globussoft.in');
                        $message->to($request->email)
                                ->subject('reset password');
                    });

                return response()->json(['success'=> 'Reset link send sucessfully']);
            }else{
                return response()->json(['notexists'=> 'user not exists']);
            }
            
        }else{

            return response()->json(['error' => $validator->errors()]);

        }

    }

    public function passwordReset_view(Request $request, $token){

                return view("User::password-reset")->with(['token'=>$token, 'email'=>$request->email]);
        }

    public function reset_done(Request $request)
        {
            $validator = Validator::make($request->all(),[
                'password' => [
                    'required',
                    'min:5',
                    'max:15',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
                ],
                'newpassword' => 'required|same:password',
            ]);

            if($validator->passes()){

                $check_token = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();


                if($check_token){

                    User::where('email',$request->email)->update([
                        'password'=> Hash::make($request->password)
                    ]);

                    DB::table('password_resets')->where([
                        'email'=>$request->email
                    ])->delete();

                        return response()->json(['success'=> 'Password reset Sucessfully']);
                    }
                else{
                    return response()->json(['token'=> $request->token]);
                    }
                
            }else{
                return response()->json(['error' => $validator->errors()]);
            }
        }
   
}
