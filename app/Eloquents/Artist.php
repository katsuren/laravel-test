<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
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
