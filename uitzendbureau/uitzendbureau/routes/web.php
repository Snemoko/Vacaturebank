<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MailController;
use App\Mail\SollicitatieMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;




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
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/huisregels', [App\Http\Controllers\HomeController::class, 'huisregels']);

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index']);
Route::post('/company', [App\Http\Controllers\CompanyController::class, 'ad']);
Route::post('/company/delete', [App\Http\Controllers\CompanyController::class, 'delete']);
Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'form']);

Route::get('/board', [App\Http\Controllers\BoardController::class, 'index']);
Route::get('/board/create', [App\Http\Controllers\BoardController::class, 'create']);
Route::post('/board/create', [App\Http\Controllers\BoardController::class, 'store']);
Route::get('/board/manage', [App\Http\Controllers\BoardController::class, 'manage']);
Route::post('/board/update', [App\Http\Controllers\BoardController::class, 'update']);
Route::post('/board/delete', [App\Http\Controllers\BoardController::class, 'delete']);
Route::get('/board/search', [App\Http\Controllers\BoardController::class, 'search']);


Route::get('/werkzoekende', [App\Http\Controllers\ProfileController::class, 'manage']);
Route::post('/werkzoekende/create', [App\Http\Controllers\ProfileController::class, 'create']);
Route::post('/werkzoekende/create/category', [App\Http\Controllers\ProfileController::class, 'createCat']);
Route::get('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/download/{file}', [App\Http\Controllers\ProfileController::class, 'download']);

Route::get('/job/seeker/board' ,[App\Http\Controllers\JobSeekerController::class, 'index']);
Route::post('/job/seeker/search', [App\Http\Controllers\JobSeekerController::class, 'search']);

Route::get('/admin',[AdminController::class,'index']);
Route::get('/admin/user',[AdminController::class,'userView']);
Route::post('/admin/user/delete',[AdminController::class,'userRemove']);
Route::get('/admin/advert',[AdminController::class,'advertView']);
Route::post('/admin/advert/delete',[AdminController::class,'advertDelete']);
Route::get('/admin/company', [AdminController::class, 'CompanyView']);
Route::post('/admin/company/delete', [AdminController::class, 'CompanyDelete']);
Route::get('/admin/vacatures', [AdminController::class, 'VacatureView']);
Route::post('/admin/vacatures/delete', [AdminController::class, 'VacatureDelete']);

Route::post('/solliciteer',[MailController::class, 'SollicitatieMail']);
Route::post('/bedrijfmail',[MailController::class, 'BedrijfMail']);




