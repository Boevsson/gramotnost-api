<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_id',
        'page_id',
        'title',
    ];
}
