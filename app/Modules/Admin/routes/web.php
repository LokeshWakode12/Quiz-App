<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Admin\Http\Controllers\DataController;
use App\Modules\Admin\Http\Controllers\QuestionController;
use App\Http\Middleware\adminCheck;


// >>>>>>>>>>> Admin register >>>>>>>>>>>>>>>
Route::view('admin/register','Admin::adminregister');
Route::post('admin-register',[AdminController::class,"admin_register"])->name('adminregister');

// >>>>>>>>>>> Admin login >>>>>>>>>>>>>>>
Route::view('admin/login','Admin::adminlogin')->name('adminloginview');
Route::post('admin-login', [AdminController::class, 'admin_login'])->name('admin-login');

Route::get('admin/logout', function () {
    Session::forget('admin_id');
    return redirect('admin/login');
});

Route::group(['prefix'=>'admin/','middleware' => 'admin' ],function(){

    // >>>>>>>>>>> Admin dashboard >>>>>>>>>>>>>>>
    Route::get('',[AdminController::class, 'welcome']);
    Route::get('dashboard',[AdminController::class, 'admindashboard'])->name('adminhome');
    Route::get('myinfoview',[AdminController::class, 'myInfo']);
    Route::get('updatemyinfo',[AdminController::class, 'myInfo']);
    Route::post('changeinfo', [AdminController::class, 'changeinfo']);

    

    // >>>>>>>>>>> User table Operations >>>>>>>>>>>>>>>
    Route::get('userdata', [DataController::class, 'userdata']);
    Route::get('Bin', [DataController::class, 'Bin']);
    Route::get('trash/{id}', [DataController::class, 'Trash']);
    Route::get('restore/{id}', [DataController::class, 'Restore']);
    Route::get('delete/{id}', [DataController::class, 'Delete']);
    Route::post('update', [DataController::class, 'Update']);
    Route::post('insert',[DataController::class, 'Insert']);
    Route::get('statistics', [DataController::class, 'Graph']);
    Route::get('/importView',[DataController::class,'importview']);
    Route::post('/importque',[DataController::class,'importque'])->name('import');


    // >>>>>>>>>>> Questions >>>>>>>>>>>>>>>
    Route::view('addquestion','Admin::addquestions');
    Route::post('storequestion', [QuestionController::class, 'storequestion'])->name('storequestion');
    Route::get('easyquestions',[QuestionController::class, 'easyquestions']);
    Route::get('mediumquestions',[QuestionController::class, 'mediumquestions']);
    Route::get('hardquestions',[QuestionController::class, 'hardquestions']);
    Route::get('deleteque/{id}',[QuestionController::class, 'deleteque']);
    Route::post('updateque',[QuestionController::class, 'updateque']);
    Route::post('insertque',[QuestionController::class, 'insertque']);
    Route::get('resultall', [QuestionController::class, 'resultall']);
    Route::get('deleteres/{id}',[QuestionController::class, 'deleteres']);


});





