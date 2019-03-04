<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Song extends Model
{
    use PimpableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $searchable = ['*'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
