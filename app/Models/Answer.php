<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'correct_answer',
        'position',
        'is_correct_answer',
        'question_id',
    ];

    public function question()
    {
        $this->belongsTo(Question::class);
    }
}
