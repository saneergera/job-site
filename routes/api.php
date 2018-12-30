<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'UserController@login'); 

Route::post('register/applicant', 'UserController@register_applicant');
Route::post('register/recuiter', 'UserController@register_recuiter');

Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UserController@details');
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});

Route::group(['prefix' => 'recruiter',  'middleware' => 'auth:api'], function()
{
    Route::post('jobs','RecruiterController@create');
    Route::get('jobs','RecruiterController@index');
    Route::get('jobs/{id}/applicants','RecruiterController@show');
});

Route::group(['prefix' => 'applicant',  'middleware' => 'auth:api'], function()
{
    Route::get('jobs','ApplicantController@index');
    Route::get('apply/{id}','ApplicantController@create');
   ;
});