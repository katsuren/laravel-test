<?php

namespace Tests\Unit\Eloquents;

use App\Eloquents\Album;
use App\Eloquents\Artist;
use App\Eloquents\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    public function testFactoryable()
    {
        $eloquent = app(Album::class);
        $this->assertEmpty($eloquent->get());
        $entity = factory(Album::class)->create();
        $this->assertNotEmpty($eloquent->get());
    }

    public function testAlbumBelongsToArtist()
    {
        $albumEloquent = app(Album::class);
        $artistEloquent = app(Artist::class);
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create([
            'artist_id' => $artist->id,
        ]);
        $this->assertNotEmpty($album->artist);
    }

    public function testAlbumHasManySongs()
    {
        $count = 5;
        $albumEloquent = app(Album::class);
        $songEloquent = app(Song::class);
        $album = factory(Album::class)->create();
        $songs = factory(Song::class, $count)->create([
            'album_id' => $album->id,
        ]);
        $this->assertEquals($count, count($album->refresh()->songs));
    }
}
