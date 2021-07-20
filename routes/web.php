<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongListController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LyricController;

Route::get('change-language/{language}', [App\Http\Controllers\HomeController::class,
    'changeLanguage'])->name('change-language');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    Route::resource('artist', App\Http\Controllers\Admin\ArtistController::class)->except('show');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except('show');
    Route::resource('lyric', App\Http\Controllers\Admin\LyricController::class)->except('show');
    Route::get('lyric/{action}/{id}', [LyricController::class, 'action'])->name('lyric.action');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'getRegister'])->name('get.register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'postRegister'])->name('post.register');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('get.login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('post.login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/get-song-by-category/{id}', [App\Http\Controllers\HomeController::class, 'getSong']);

Route::get('/{songId}', [App\Http\Controllers\HomeController::class, 'songPlaying'])->name('home.songPlaying');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'getRegister'])->name('get.register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'postRegister'])->name('post.register');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('get.login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('post.login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/get-song-by-category/{id}', [App\Http\Controllers\HomeController::class, 'getSong']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{songId}', [App\Http\Controllers\HomeController::class, 'songPlaying'])->name('home.songPlaying');
