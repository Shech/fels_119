<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'image',
    ];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
