<?php

namespace Tests\Unit\Eloquents;

use App\Eloquents\Album;
use App\Eloquents\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SongTest extends TestCase
{
    use RefreshDatabase;

    public function testFactoryable()
    {
        $eloquent = app(Song::class);
        $this->assertEmpty($eloquent->get());
        $entity = factory(Song::class)->create();
        $this->assertNotEmpty($eloquent->get());
    }

    public function testSongBelongsToAlbum()
    {
        $albumEloquent = app(Album::class);
        $songEloquent = app(Song::class);
        $album = factory(Album::class)->create();
        $song = factory(Song::class)->create([
            'album_id' => $album->id,
        ]);
        $this->assertNotEmpty($song->album);
    }
}
