<?php

namespace Tests\Unit\Eloquents;

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
}
