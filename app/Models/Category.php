<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color',
        'subsection_id',
    ];

    protected $casts = ['subsection_id' => 'integer'];

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order', 'asc');
    }
}
