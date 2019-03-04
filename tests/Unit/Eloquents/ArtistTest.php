<?php

namespace Tests\Unit\Eloquents;

use App\Eloquents\Album;
use App\Eloquents\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    public function testFactoryable()
    {
        $eloquent = app(Artist::class);
        $this->assertEmpty($eloquent->get());
        $entity = factory(Artist::class)->create();
        $this->assertNotEmpty($eloquent->get());
    }

    public function testArtistHasManyAlbums()
    {
        $count = 5;
        $artistEloquent = app(Artist::class);
        $albumEloquent = app(Album::class);
        $artist = factory(Artist::class)->create();
        $albums = factory(Album::class, $count)->create([
            'artist_id' => $artist->id,
        ]);
        $this->assertEquals($count, count($artist->refresh()->albums));
    }
}
