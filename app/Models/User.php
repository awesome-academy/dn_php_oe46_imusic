<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'avatar',
        'provider_id', 'provider',
        'access_token'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function playLists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lyrics()
    {
        return $this->hasMany(Lyric::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'favorite_user_album', 'user_id', 'album_id');
    }

    public function scopeAlluser($query)
    {
        return $query->orderBy('fullname', 'desc');
    }
}
