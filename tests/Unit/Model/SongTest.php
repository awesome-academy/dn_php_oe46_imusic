<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use App\Models\Song;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SongTest extends TestCase
{
    public function test_hasMany_comments()
    {
        $song = new Song();

        $relation = $song->comments();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('song_id', $relation->getForeignKeyName());

        $this->assertEquals('songs.id', $relation->getQualifiedParentKeyName());
    }

    public function test_belongsTo_artist()
    {
        $song = new Song();

        $relation = $song->artist();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('artist_id', $relation->getForeignKeyName());
    }

    public function test_belongsToMany_albums()
    {
        $song = new Song();

        $relation = $song->albums();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('album_song.song_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('album_song.album_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_hasOne_lyrics()
    {
        $song = new Song();

        $relation = $song->lyrics();

        $this->assertInstanceOf(HasOne::class, $relation);

        $this->assertEquals('song_id', $relation->getForeignKeyName());

        $this->assertEquals('songs.id',$relation->getQualifiedParentKeyName());
    }

    public function test_belongsTo_category()
    {
        $song = new Song();

        $relation = $song->category();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('cate_id', $relation->getForeignKeyName());
    }

    public function test_belogsToMany_playLists()
    {
        $song = new Song();

        $relation = $song->playLists();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('playlist_song.song_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('playlist_song.playlist_id', $relation->getQualifiedRelatedPivotKeyName());
    }

}
