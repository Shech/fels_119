<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

    const OPTION_COUNT = 3;

    protected $fillable = [
        'vietnamese_words',
        'japanese_words',
        'word_options',
        'sound_file',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_words', 'word_id', 'user_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_words', 'word_id', 'lesson_id');
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function userWord()
    {
        return $this->belongsTo(UserWord::class);
    }
}
