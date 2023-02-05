<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo_url',
        'logo_local_path',
        'home_page_text',
        'email',
        'phone',
        'address'
    ];
}
