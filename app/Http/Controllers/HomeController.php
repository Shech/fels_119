<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserWord;

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
        if ($this->user->isMember()) {
            $user = User::find($this->user->id);
            $lessonId = Activity::where('user_id', auth()->id())->lists('lesson_id');
            $lessons = Lesson::whereIn('id', $lessonId)
                ->with('category')
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
            $userWordCount = UserWord::where('user_id', auth()->id())->count();
            return view('home', compact('lessons', 'user', 'userWordCount'));
        } else {
            $activities = Activity::with('user.lessons.category')->orderBy('id', 'desc')->take(5)->get();
            $topCategories = Lesson::select(\DB::raw('count(id) as lesson_count, category_id'))
                ->groupBy('category_id')
                ->orderBy('lesson_count', 'desc')
                ->with('category')
                ->get();
            return view('admin', compact('activities', 'topCategories'));
        }

    }
}
