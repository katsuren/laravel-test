<?php

namespace Tests\Unit\Eloquents;

use App\Eloquents\Album;
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
}
