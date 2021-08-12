<?php

namespace App\Repositories\Song;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File;
use App\Repositories\Song\ISongRepository;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use App\Jobs\SendNotifiNewSongJob;
use Mail;
use App\Mail\NotificationNewSong;
use Carbon\Carbon;
use App\Notifications\NewSongNotify;
use Pusher\Pusher;
use App\Events\NotificationEventSong;
use Illuminate\Support\Facades\DB;

class SongRepository extends BaseRepository implements ISongRepository
{
    public function getModel()
    {
        return Song::class;
    }

    public function showAll()
    {
        $songs =$this->model::orderById()->paginate(config('app.paginate_num'));

        return $songs;
    }

    public function create($data)
    {
        $image = $data['image'];
        $image_path = 'image_product/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_product');
        $image->move($path, $image_path);

        $song = $this->model::create([
            'name' => $data['name'],
            'cate_id'=>$data['cate_id'],
            'image' =>$image_path,
            'link'=>$data['link'],
            'artist_id' => $data['art_id']
        ]);

        $this->sendNotify($song);

        return $song;
    }

    public function getAllArtist()
    {
        return Artist::all();
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getArtist($id)
    {
        $song = $this->findOrFail($id);
        return Artist::where('id', $song->artist->id);
    }

    public function getCategory($id)
    {
        $song = $this->findOrFail($id);
        return Category::where('id', $song->category->id);
    }

    public function update($id, $data)
    {
        $song = $this->findOrFail($id);
        $image = $data['image'];

        if (File::exists(public_path('storage/' .  $song->image_path))) {
            File::delete(public_path('storage/' . $song->image_path));
        }

        $image_path = 'image_product/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_product');

        $image->move($path, $image_path);

        $song = $song->update([
            'name' => $data['name'],
            'cate_id'=>$data['cate_id'],
            'image' =>$image_path,
            'link'=>$data['link'],
            'artist_id' => $data['art_id']
        ]);

        return $song;
    }

    public function delete($id)
    {
        $song = $this->findOrFail($id);
        $song->lyrics()->delete();
        $song->comments()->delete();
        $song->albums()->wherePivot('song_id', $song->id)->detach();
        $song->playLists()->wherePivot('song_id', $song->id)->detach();
        $song->delete();
    }

    public function actionHot($action, $id)
    {
        $song = $this->findOrFail($id);
        switch ($action) {
            case 'hot':
                $song->hot = $song->hot ? config('app.notHot') : config('app.Hot');
                $song->save();
                break;
        }
    }

    public function getSongNew()
    {
        return $this->model::orderBy('created_at', 'desc')->take(config('app.home_take_number'))->get();
    }

    public function songPlaying($id)
    {
        $song = $this->findOrFail($id);
        $song->view += 1;
        $song->save();
        return $song;
    }

    public function getSongofCategory($id)
    {
        return $this->model::ofCategory($id)->get();
    }

    public function getSongHot()
    {
        return $this->model->songHot();
    }

    public function topTrending()
    {
        return $this->model::select('view', 'name', 'id', 'image', 'cate_id')
        ->whereMonth('created_at', date('m'))->orderBy('view', 'desc')->get();
    }

    public function searchName($search)
    {
        return $this->model->searchName($search)->take(config('app.home_take_number'))->get();
    }

    public function searchSong($search)
    {
        return $this->model->searchName($search)->paginate(config('app.search_take_num'));
    }

    public function sendNotify($song)
    {
        $users = User::where('is_admin', config('app.user'))->get();

        foreach ($users as $user) {
            dispatch(new SendNotifiNewSongJob($user, $song))->delay(Carbon::now()->addSeconds(10));

            $user->notify(new NewSongNotify($song));
        }

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $time = $song->created_at->diffForHumans();
        $title = trans('home.newSongNoti');

        $pusher->trigger('NotificationEventSong', 'send-message', ['song' =>$song,'time'=>$time, 'title'=>$title]);
    }

    public function markAsRead($notificationId)
    {
         $noti = DB::table('notifications')->where('id', $notificationId)->update(['read_at' => Carbon::now()]);
    }
}
