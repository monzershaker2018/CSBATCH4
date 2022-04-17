<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes(['register' => false]);

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// main route
    Route::get('/', 'App\Http\Controllers\Front\MainController@index');
    //Route::get('/login', 'App\Http\Controllers\Front\MainController@login');




// dashboard routes
Route::prefix('dashboard')->middleware('auth')->group(function(){

    Route::get('/index', 'App\Http\Controllers\Front\MainController@home');

    Route::get('/change-password', 'App\Http\Controllers\HomeController@change_password');

    //attachemnts routes
Route::resource('attachments', App\Http\Controllers\AttachmentsController::class);

//sections routes
Route::resource('sections', App\Http\Controllers\SectionController::class);

//users routes
Route::resource('users', App\Http\Controllers\UserController::class);

//semesters routes
Route::resource('semesters', App\Http\Controllers\SemesterController::class);

//subjects routes
Route::resource('subjects', App\Http\Controllers\SubjectController::class);
Route::get('/getAttach/{id}', 'App\Http\Controllers\SubjectController@getAttach')->name('getAttach');

Route::post('search_subjects', 'App\Http\Controllers\SubjectController@search_subjects')->name('search_subjects');

// change password
Route::post('change', 'App\Http\Controllers\HomeController@change')->name('change');



});

// others routes
Route::get('/user_get_Attach/{id}', 'App\Http\Controllers\Front\MainController@getAttach')->name('user_get_Attach');
Route::post('user_search_subjects', 'App\Http\Controllers\Front\MainController@search_subjects')->name('user_search_subjects');

Route::get('/section/{id}', 'App\Http\Controllers\SubjectController@getsemesters');
Route::get('/attach/{id}', 'App\Http\Controllers\AttachmentsController@getSubjects');

Route::get('/view_file/{subject}/{source}', 'App\Http\Controllers\AttachmentsController@show_file')->name('view_file');
Route::get('/download_file/{subject}/{source}', 'App\Http\Controllers\AttachmentsController@download_file')->name('download_file');


// dashboard routes
 Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

