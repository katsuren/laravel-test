<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Album extends Model
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

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
