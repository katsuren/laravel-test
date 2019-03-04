<?php

namespace Tests\Feature;

use App\Eloquents\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ArtistsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanSeeIndex()
    {
        $response = $this->get('/artists');
        $response->assertOk()
            ->assertSee('action="/artists"')
            ->assertSee('name="search[name]"');
    }

    public function testCanSeeShow()
    {
        $artist = factory(Artist::class)->create();

        $response = $this->get('/artists/' . $artist->id);
        $response->assertOk()
            ->assertSee($artist->name);
    }

    public function testCanCreate()
    {
        $response = $this->get('/artists/create');
        $response->assertOk()
            ->assertSee('action="/artists"')
            ->assertSee('name="artist[name]"');

        $name = Str::random(10);
        $response = $this->from('/artists/create')->post('/artists', [
            'artist' => [
                'name' => $name,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('artists', ['name' => $name]);
    }

    public function testCanUpdate()
    {
        $artist = factory(Artist::class)->create();
        $response = $this->get('/artists/' . $artist->id . '/edit');
        $response->assertOk()
            ->assertSee('action="/artists/' . $artist->id . '"')
            ->assertSee('name="artist[name]"');

        $name = Str::random(10);
        $response = $this->from('/artists/' . $artist->id . '/edit')->put('/artists/' . $artist->id, [
            'artist' => [
                'name' => $name,
            ],
        ]);
        $response->assertRedirect();

        $this->assertDatabaseHas('artists', ['name' => $name]);
    }

    public function testCanDelete()
    {
        $artist = factory(Artist::class)->create();
        $this->assertDatabaseHas('artists', ['id' => $artist->id]);

        $response = $this->from('/artists')->delete('/artists/' . $artist->id);
        $response->assertRedirect();

        $this->assertDatabaseMissing('artists', ['id' => $artist->id]);
    }
}
