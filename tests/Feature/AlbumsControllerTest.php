<?php

namespace Tests\Feature;

use App\Eloquents\Album;
use App\Eloquents\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AlbumsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanSeeIndex()
    {
        $response = $this->get('/albums');
        $response->assertOk()
            ->assertSee('action="/albums"')
            ->assertSee('name="search[name]"')
            ->assertSee('name="search[artist:name]"');
    }

    public function testCanSeeShow()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);

        $response = $this->get('/albums/' . $album->id);
        $response->assertOk()
            ->assertSee($album->name);
    }

    public function testCanCreate()
    {
        $artist = factory(Artist::class)->create();
        $response = $this->get('/albums/create');
        $response->assertOk()
            ->assertSee('action="/albums"')
            ->assertSee('name="album[artist_id]"')
            ->assertSee('name="album[name]"');

        $name = Str::random(10);
        $response = $this->from('/albums/create')->post('/albums', [
            'album' => [
                'name' => $name,
                'artist_id' => $artist->id,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('albums', ['name' => $name]);
    }

    public function testCanUpdate()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);
        $response = $this->get('/albums/' . $album->id . '/edit');
        $response->assertOk()
            ->assertSee('action="/albums/' . $album->id . '"')
            ->assertSee('name="album[name]"')
            ->assertSee('name="album[artist_id]"');

        $name = Str::random(10);
        $response = $this->from('/albums/' . $album->id . '/edit')->put('/albums/' . $album->id, [
            'album' => [
                'name' => $name,
                'artist_id' => $artist->id,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('albums', ['name' => $name]);
    }

    public function testCanDelete()
    {
        $artist = factory(Artist::class)->create();
        $album = factory(Album::class)->create(['artist_id' => $artist->id]);
        $this->assertDatabaseHas('albums', ['id' => $album->id]);

        $response = $this->from('/albums')->delete('/albums/' . $album->id);
        $response->assertRedirect();

        $this->assertDatabaseMissing('albums', ['id' => $album->id]);
    }
}
