<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Session;

class facebookController extends Controller
{
    public function loginwithfacebook(Request $request){

        return Socialite::driver('facebook')->redirect();
    }

    public function callbackfb(){

        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            $saveuser = User::updateOrCreate([
                'facebook_id' => $user->getId(),
            ],[
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ]);
            Session::put('userid' , $saveuser->id);

            return redirect()->route('home');
            
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
