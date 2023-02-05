<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'text',
        'slug',
        'video_links'
    ];

    protected $casts = [
        'video_links' => 'json'
    ];

    public function files()
    {
      return $this->belongsToMany(File::class, 'page_files')->withPivot('file_title', 'file_text', 'file_image_url');
    }
}
