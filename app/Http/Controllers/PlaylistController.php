<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PlaylistRequest;

class PlaylistController extends Controller
{
    public function showPlaylists()
    {
        $albums = Auth::user()->albums;
        $playlists = Auth::user()->playlists;

        return view('playlist', compact('playlists', 'albums'));
    }

    public function createPlaylists()
    {
        return view('createPlaylist');
    }

    public function storePlaylists(Request $request)
    {
        $playlist = new Playlist;
        $playlist->name = $request->name;
        $playlist->user_id = Auth::user()->id;
        $playlist->save();
        
        try {
            $albums = Auth::user()->albums;
            $playlists = Auth::user()->playlists;
            
            return view('playlist', compact('playlists', 'albums'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function addAlbum($id)
    {
        $check = Auth::user()->albums->where('id', $id)->count();
        if ($check > 0) {
            return $message = 'This album is already exists in your playlist.';
        } else {
            try {
                $user = Auth::user()->albums()->attach($id);
                $album = Album::where('id', $id)->get();
                return response()->json([
                    'error'  => false,
                    'user'   => $user,
                    'album' => $album,
                ], 200);
            } catch (Throwable $e) {
                return redirect()->back()->with('danger', trans('playlist.notFoundAlbum'));
            }
        }
    }

    public function playlistDetail($id)
    {
        try {
            $playlist = Playlist::find($id);
            $songs = $playlist->songs;
            
            return view('playlistSong', compact('songs', 'playlist'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function favoriteAlbum($id)
    {
        try {
            $album = Album::find($id);
            $songs = $album->songs;
            
            return view('playlistSong', compact('songs', 'album'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function delPlaylist($id)
    {
        try {
            $playlist = Playlist::find($id);
            $playlist->songs()->wherePivot('playlist_id', '=', $id)->detach();
            $playlist->delete();
            
            return response()->json([
                'error' => false,
                'playlist'  => $playlist,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function delFavAlbum($id)
    {
        try {
            $album = Auth::user()->albums()->detach($id);
    
            return response()->json([
                'error' => false,
                'album'  => $album,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundAlbum'));
        }
    }

    public function showSongList($id)
    {
        return view('showAddSong', compact('id'));
    }
    
    public function songResult($playlistId, $search)
    {
        try {
            $songs = Song::where('name', 'like', '%'.$search.'%')->take(config('app.home_take_number'))->get();

            return view('songResult', compact('songs', 'playlistId'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noSearchFound'));
        }
    }

    public function addPlaylistSong($playlistId, $song)
    {
        try {
            $playlist = Playlist::find($playlistId);
            $playlist->songs()->attach($song);
            
            return response()->json([
                'error' => false,
                'playlist'  => $playlist,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noPlaylistFound'));
        }
    }

    public function delPlaylistSong($playlistId, $song)
    {
        try {
            $playlist = Playlist::find($playlistId);
            $playlist->songs()->detach($song);
            
            return response()->json([
                'error' => false,
                'playlist'  => $playlist,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noPlaylistFound'));
        }
    }

    public function addFavoriteSong($song)
    {
        $playlists = Auth::user()->playlists;
        $result = $playlists->where('name', '=', 'Favorite');
        if (count($result) == 0) {
            $favorite = new Playlist;
            $favorite->name = "Favorite";
            $favorite->user_id = Auth::user()->id;
            $favorite->save();
        }
        $favorite = $playlists->where('name', '=', 'Favorite')->first();
        $favorite->songs()->attach($song);

        return response()->json([
            'error' => false,
            'favorite'  => $favorite,
        ], 200);
    }
}
