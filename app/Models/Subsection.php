<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color',
        'video_link',
        'challenge_id',

    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
