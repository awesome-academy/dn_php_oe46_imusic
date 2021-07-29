<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongListController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\PageDetailController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\LyricController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('change-language/{language}', [App\Http\Controllers\HomeController::class,
    'changeLanguage'])->name('change-language');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);

    Route::get('albums/{album}/album-song', [AlbumController::class, 'albumSong'])->name('albumSong');

    Route::get('albums/{album}/add-song', [AlbumController::class, 'getAddSong'])->name('getAddSong');

    Route::get('albums/{album}/add-song/{song}', [AlbumController::class, 'addAlbumSong'])->name('addAlbumSong');

    Route::get('albums/{album}/del-song/{song}', [AlbumController::class, 'delAlbumSong'])->name('delAlbumSong');

    Route::resource('songs', SongController::class);

    Route::resource('artist', App\Http\Controllers\Admin\ArtistController::class)->except('show');

    Route::get('albums/{action}/{id}', [AlbumController::class, 'action'])->name('albums.action');

    Route::get('songs/{action}/{id}', [SongController::class, 'action'])->name('songs.action');

    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except('show');

    Route::resource('lyric', App\Http\Controllers\Admin\LyricController::class)->except('show');

    Route::get('lyric/{action}/{id}', [LyricController::class, 'action'])->name('lyric.action');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace'=>''],function (){
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'getRegister'])->name('get.register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'postRegister'])->name('post.register');
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('get.login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('post.login');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('oauth/{driver}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social.oauth');
    Route::get('oauth/{driver}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('social.callback');
});

Route::get('/get-song-by-category/{id}', [App\Http\Controllers\HomeController::class, 'getSong']);

Route::get('album-detail/{album}', [PageDetailController::class, 'showAlbum'])->name('showAlbum');
Route::get('artist-detail/{artist}', [PageDetailController::class, 'showArtist'])->name('showArtist');

Route::get('/song/{id}', [App\Http\Controllers\HomeController::class, 'songPlaying']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('playlists', [PlaylistController::class, 'showPlaylists'])->name('playlists');
    Route::get('create-playlists', [PlaylistController::class, 'createPlaylists'])->name('createPlaylists');
    Route::post('store-playlists', [PlaylistController::class, 'storePlaylists'])->name('storePlaylists');
    Route::post('add-album/{id}', [PlaylistController::class, 'addAlbum'])->name('addAlbum');
    Route::get('playlist-detail/{id}', [PlaylistController::class, 'playlistDetail'])->name('playlistDetail');
    Route::get('favorite-album/{id}', [PlaylistController::class, 'favoriteAlbum'])->name('favoriteAlbum');
    Route::post('del-playlist/{id}', [PlaylistController::class, 'delPlaylist'])->name('delPlaylist');
    Route::post('del-fav-album/{id}', [PlaylistController::class, 'delFavAlbum'])->name('delFavAlbum');
    Route::get('song-list/{id}', [PlaylistController::class, 'showSongList'])->name('showSongList');
    Route::post('playlist/{playlistId}/search/{search}', [PlaylistController::class, 'songResult'])->name('songResult');
    Route::post('playlist/{playlistId}/song/{song}', [PlaylistController::class, 'addPlaylistSong'])
    ->name('addPlaylistSong');
    Route::post('playlist/{playlistId}/del-song/{song}', [PlaylistController::class, 'delPlaylistSong'])
    ->name('delPlaylistSong');
    Route::post('favorite-song/{song}', [PlaylistController::class, 'addFavoriteSong'])->name('addFavoriteSong');
});



Route::get('/top-trending-song', [App\Http\Controllers\HomeController::class, 'topTrending'])->name('top-trending');
Route::get('/show-category', [App\Http\Controllers\HomeController::class, 'renderHome']);

Route::get('album-detail/{album}', [PageDetailController::class, 'showAlbum'])->name('showAlbum');

Route::get('artist-detail/{artist}', [PageDetailController::class, 'showArtist'])->name('showArtist');

Route::get('/detail-song/{id}', [App\Http\Controllers\SongController::class, 'detailSong']);

Route::get('search/{search}', [HomeController::class, 'searchFeature'])->name('home.search');

Route::get('/hot/{type}', [App\Http\Controllers\HomeController::class, 'hotAlbumMusic']);

Route::post('/song-comment', [App\Http\Controllers\SongController::class, 'storeComent'])->middleware('auth');

Route::post('/add-lyric', [App\Http\Controllers\SongController::class, 'addLyric'])->middleware('auth');

Route::get('/info-profile/{id}', [App\Http\Controllers\UserController::class, 'proFile']);
Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword']);

Route::get('search/{type}/key/{search}', [HomeController::class, 'searchType'])->name('searchType');
