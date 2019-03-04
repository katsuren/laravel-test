<?php

namespace Tests\Feature;

use App\Eloquents\Album;
use App\Eloquents\Artist;
use App\Eloquents\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SongsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanSeeIndex()
    {
        $response = $this->get('/songs');
        $response->assertOk()
            ->assertSee('action="/songs"')
            ->assertSee('name="search[name]"')
            ->assertSee('name="search[album:name]"');
    }

    public function testCanSeeShow()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);
        $song = factory(Song::class)->create(['album_id' => $album->id]);

        $response = $this->get('/songs/' . $song->id);
        $response->assertOk()
            ->assertSee($song->name);
    }

    public function testCanCreate()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create();
        $response = $this->get('/songs/create');
        $response->assertOk()
            ->assertSee('action="/songs"')
            ->assertSee('name="song[album_id]"')
            ->assertSee('name="song[name]"');

        $name = Str::random(10);
        $response = $this->from('/songs/create')->post('/songs', [
            'song' => [
                'name' => $name,
                'album_id' => $album->id,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('songs', ['name' => $name]);
    }

    public function testCanUpdate()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);
        $song = factory(Song::class)->create(['album_id' => $album->id]);
        $response = $this->get('/songs/' . $song->id . '/edit');
        $response->assertOk()
            ->assertSee('action="/songs/' . $song->id . '"')
            ->assertSee('name="song[name]"')
            ->assertSee('name="song[album_id]"');

        $name = Str::random(10);
        $response = $this->from('/songs/' . $song->id . '/edit')->put('/songs/' . $song->id, [
            'song' => [
                'name' => $name,
                'album_id' => $album->id,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('songs', ['name' => $name]);
    }

    public function testCanDelete()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);
        $song = factory(Song::class)->create(['album_id' => $album->id]);
        $this->assertDatabaseHas('songs', ['id' => $song->id]);

        $response = $this->from('/songs')->delete('/songs/' . $song->id);
        $response->assertRedirect();

        $this->assertDatabaseMissing('songs', ['id' => $song->id]);
    }
}
