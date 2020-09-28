<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("route1");

Route::group(['namespace' => 'App\Http\Controllers\Front', 'prefix' => 'users'], function () {
    Route::get("default", "UserController@default");
});

Route::get("/login", function () {
    return "You must login first";
})->name("login");
/*
Route::group(["namespace" => "App\Http\Controllers\Front"], function () {
    Route::resource("doctors", "DoctorController"); // call index method
    Route::resource("doctors/{id}", "DoctorController"); // call show method
    Route::resource("doctors/{id}/edit", "DoctorController"); // call edit method
});
*/
/*
Route::get("/test", function () {
    $data = ["name" => "hamza salah", "id" => 3];
    return view("test", $data);
});
*/
Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::resource("employees", "EmployeeController");
    Route::resource("employees/{id}/edit", "EmployeeController");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("verified");
Route::get("/", [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("verified");

Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::get("/redirect/{service}", "SocialController@redirectToProvider");
    Route::get("/callback/{service}", "SocialController@callback");
});
