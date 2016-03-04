<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'lesson_words', 'lesson_id', 'word_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
