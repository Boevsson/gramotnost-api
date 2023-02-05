<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'local_path',
        'url',
    ];

    public function pages()
    {
       return $this->belongsToMany(Page::class, 'page_files')->withPivot('file_title', 'file_text', 'file_image_url');
    }
}
