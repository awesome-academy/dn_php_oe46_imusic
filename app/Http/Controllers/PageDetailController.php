<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Repositories\Album\IAlbumRepository;
use App\Repositories\Artist\ArtistRepository;

class PageDetailController extends Controller
{
    protected $albumReporitory;
    protected $artistRepository;

    public function __construct(
        IAlbumRepository $albumReporitory,
        ArtistRepository $artistRepository
    ) {
        $this->albumReporitory = $albumReporitory;
        $this->artistRepository = $artistRepository;
    }
    public function showAlbum($album)
    {
        try {
            $album = $this->albumReporitory->findOrFail($album);
            $songs = $album->songs;

            return view('detail', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundAlbum'));
        }
    }

    public function showArtist($artist)
    {
        try {
            $artist = $this->artistRepository->findOrFail($artist);
            $songs = $artist->songs;

            return view('detail', compact('artist', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundArtist'));
        }
    }
}
