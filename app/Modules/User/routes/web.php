<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Http\Controllers\UserController;
use App\Modules\User\Http\Controllers\QuizController;
use App\Modules\User\Http\Controllers\facebookController;
use App\Modules\User\Http\Controllers\GoogleController;

Route::get('user', 'UserController@welcome');

Route::view('user/register','User::userregister');
Route::post('user-register',[UserController::class,"user_register"])->name('userregister');

// >>>>>>>>>>> Admin login >>>>>>>>>>>>>>>
Route::view('user/login','User::userlogin')->name('userloginview');
Route::post('user-login', [UserController::class, 'user_login'])->name('user-login');

Route::get('/logoutuser', function () {
    Session::forget('userid');
    return redirect('user/login');
});

Route::group(['prefix'=>'user/','middleware' => 'user' ],function(){

    // >>>>>>>>>>> Admin dashboard >>>>>>>>>>>>>>>
    Route::get('', 'UserController@master');
    Route::get('dashboard',[UserController::class, 'userdashboard'])->name('home');

    // Route::view('startquiz','User::quizpanel');
    Route::get('startquiz', [QuizController::class, 'startquiz']);
    Route::post('datasend', [QuizController::class, 'datasend'])->name('datasend');
    Route::get('result',[QuizController::class, 'result'])->name('result');
    Route::get('endtest', [QuizController::class, 'endTest']);
    Route::get('myresult', [QuizController::class, 'myresult']);
});

// >>>>>>>>>>>>>>>>>>>>>>>>> forget password >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::get('/forget',[UserController::class,"forget_view"])->name('forget');
Route::post('/newpass', [UserController::class, 'forget_link'])->name('newpass');
Route::get('/password-reset/{token}', [UserController::class, 'passwordReset_view'])->name('password-reset');
Route::post('/resetpassword', [UserController::class, 'reset_done'])->name('reset-password');



// >>>>>>>>>>>>>>>>>>>>>>>>>>>> login with facebook >>>>>>>>>>>>>>>>>>>>>>>>>>>>

Route::prefix('facebook')->group(function(){
    Route::get('authfb',[facebookController::class,'loginwithfacebook'])->name('loginfb');
    Route::get('callbackfb',[facebookController::class,'callbackfb'])->name('callbackfb');
});

// >>>>>>>>>>>>>>>>>>>>>>>>>>>> login with google >>>>>>>>>>>>>>>>>>>>>>>>>>>>

Route::prefix('google')->group(function(){
    Route::get('authgoogle',[GoogleController::class,'loginwithgoogle'])->name('logingoogle');
    Route::any('callbackgo',[GoogleController::class,'callbackgoogle'])->name('callbackgoogle');
});












