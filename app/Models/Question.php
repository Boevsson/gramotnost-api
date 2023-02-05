<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'question',
            'text',
            'side_text',
            'order',
            'type_id',
            'category_id',
        ];

    public function type()
    {
        $this->belongsTo(QuestionType::class);
    }

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->belongsToMany(File::class, 'question_images', 'question_id', 'image_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
