<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostsController;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\RegisterController;
use \Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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


Route::get('/', function (){
    return view('welcome');
});
    Route::post('registration', [MainController::class, 'save'])->name('save');
    Route::post('/check', [MainController::class, 'check'])->name('check');
    Route::get('logout', [MainController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['AuthCheck']], function () {
        Route::get('login', [MainController::class, 'login'])->name('login');
        Route::get('registration', [MainController::class, 'register'])->name('registration');

        Route::get('private', ['middleware' => 'auth', MainController::class, 'private'])->name('private');
    });
    Route::post('private', [MainController::class, 'update_avatar'])->name('update_avatar');

    Route::get('gallery', [MainController::class, 'gallery'])->name('gallery');
    Route::post('gallery', [MainController::class, 'update_gallery'])->name('gallery_photo');

    Route::get('slider', [MainController::class, 'slider']);
    Route::post('slider', [MainController::class, 'slider_save'])->name('slider_save');

    Route::get('post',[MainController::class,'post']);
    Route::post('/post',[MainController::class,'post_save'])->name('post');

    Route::get('edit/{id}',[MainController::class, 'edit'])->name('edit');
    Route::get('/add_lang/{id}/{language_id}',[MainController::class, 'add_language'])->name('add_lang');

    Route::get('group', [MainController::class, 'group'])->name('group');
    Route::post('group', [MainController::class, 'marge'])->name('marge');


    Route::group(['prefix' => '{locale?}'], function () {
        Route::get('/', function (){
          return view('welcome');
        })->name('welcome');
        Route::post('registration', [MainController::class, 'save'])->name('save');
        Route::post('/check', [MainController::class, 'check'])->name('check');
        Route::get('logout', [MainController::class, 'logout'])->name('logout');

//    Route::group(['middleware' => ['AuthCheck']], function () {
        Route::get('login', [MainController::class, 'login'])->name('login');
        Route::get('registration', [MainController::class, 'register'])->name('registration');
        Route::get('private', ['middleware' => 'auth', MainController::class, 'private'])->name('private');
//    });

        Route::post('private', [MainController::class, 'update_avatar'])->name('update_avatar');

        Route::get('gallery', [MainController::class, 'gallery'])->name('gallery');
        Route::post('gallery', [MainController::class, 'update_gallery'])->name('gallery_photo');


        Route::get('slider', [MainController::class, 'slider']);
        Route::post('slider', [MainController::class, 'slider_save'])->name('slider_save');

        Route::post('/post',[MainController::class,'post_save'])->name('post');
        Route::get('/edit/{id}',[MainController::class, 'edit'])->name('edit/{id}');
        Route::get('/add_lang/{id}/{language_id}',[MainController::class, 'add_language'])->name('add_lang');

       Route::get('group', [MainController::class, 'group'])->name('group');
       Route::post('group', [MainController::class, 'marge'])->name('marge');
    });
Auth::routes();


