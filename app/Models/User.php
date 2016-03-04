<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const TYPE_ADMIN = 1;
    const TYPE_MEMBER = 2;

    protected $fillable = [
        'name', 'email', 'password', 'image', 'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function words()
    {
        return $this->belongsToMany(Word::class, 'user_words', 'user_id', 'word_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followers_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function isAdmin()
    {
        return self::TYPE_ADMIN == $this->role;
    }
}
