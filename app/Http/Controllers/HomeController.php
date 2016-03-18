<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Lesson;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find($this->user->id);
        $lessonId = Activity::where('user_id', $this->user->id)->lists('lesson_id');
        $lessons = Lesson::whereIn('id', $lessonId)
            ->with('category')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        return view('home', compact('lessons', 'user'));
    }
}
