<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;;
use Session;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;


class GoogleController extends Controller
{
    public function loginwithgoogle(){

        return Socialite::driver('google')->redirect();
    }

    public function callbackgoogle(){
        
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $is_user = User::where('email',$user->getEmail())->first();

            if(!$is_user){
                $saveuser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make('google12345'),
                ]);
            }
            else{
                $saveuser = User::where('email',$user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
            }

            $id = User::where('email',$user->getEmail())->value('id');
            Session::put('userid',$id);

            return redirect()->route('home');

        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
