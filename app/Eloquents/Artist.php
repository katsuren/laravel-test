<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Artist extends Model
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

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
