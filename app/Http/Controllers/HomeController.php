<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function changeLanguage($locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    
    public function index()
    {
        $songs = Song::where('hot',1)->get();

        return view('home', compact('songs'));
    }

    public function songPlaying($id)
    {
        try {
            $song = Song::find($id);
    
            return view('song-play', compact('song'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('songNotFound'));
        }
    }
}
