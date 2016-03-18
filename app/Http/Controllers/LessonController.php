<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\UserWord;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        session()->forget('wordId');
        $learnedWords = UserWord::where('user_id', $this->user->id)->with('words')->lists('word_id');
        $wordsPerCategory = Category::with(['words' => function ($query) use ($learnedWords) {
            $query->whereIn('id', $learnedWords);
        }])->get();
        return view('lesson.index', compact('wordsPerCategory'));
    }

    public function show(Lesson $lesson)
    {
        if (session()->has('wordId')) {
            if (LessonWord::where('id', session('wordId'))->where('lesson_id', $lesson->id)->count()) {
                $lessonWord = LessonWord::where('id', session('wordId'))->where('lesson_id', $lesson->id)->with('word')->first();
                $options = $this->shuffleOptions($lessonWord);
                return view('lesson.create', compact('lessonWord', 'options'));
            } else {
                session()->forget('wordId');
                Activity::insert([
                    'user_id' => $this->user->id,
                    'lesson_id' => $lesson->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return redirect('lessons/' . $lesson->id . '/results');
            }
        } else {
            $lessonWord = LessonWord::where('lesson_id', $lesson->id)->with('word')->first();
            session()->put('wordId', $lessonWord->id);
            $options = $this->shuffleOptions($lessonWord);
            return view('lesson.create', compact('lessonWord', 'options'));
        }
    }

    public function update(Request $request, Lesson $lesson)
    {
        $word = Word::with(['lessonWords' => function ($query) use ($lesson) {
            $query->where('lesson_id', $lesson->id);
        }])->where('japanese_words', $request->selected_word)->first();
        if (count($word) && count($word->lessonWords)) {
            LessonWord::where('id', $word->lessonWords->first()->id)->update(['result' => Lesson::ANSWER_CORRECT]);
        } else {
            LessonWord::where('id', session('wordId'))->update(['result' => Lesson::ANSWER_WRONG]);
        }
        session()->put('wordId', session('wordId') + 1);
        return redirect('lessons/' . $lesson->id);
    }

    public function store(Request $request)
    {
        $learnedWords = UserWord::where('user_id', $this->user->id)->with('words')->lists('word_id');
        $userWord = Category::with(['words' => function ($query) use ($learnedWords) {
            $query->whereIn('id', $learnedWords);
        }])->find($request->categoryId);
        $categoryWordsCount = Word::where('category_id', $request->categoryId)->count();
        if (count($userWord->words) <= $categoryWordsCount) {
            do {
                $words = Word::where('category_id', $request->categoryId)->lists('id')->random(20);
            } while (UserWord::whereIn('word_id', $words)->where('user_id', $this->user->id)->count());

            $lessonId = Lesson::insertGetId([
                'user_id' => $this->user->id,
                'category_id' => $request->categoryId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            foreach ($words as $word) {
                $lessonWordData[] = [
                    'lesson_id' => $lessonId,
                    'word_id' => intval($word),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $userWordData[] = [
                    'user_id' => $this->user->id,
                    'word_id' => intval($word),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            UserWord::insert($userWordData);
            LessonWord::insert($lessonWordData);
            return redirect('lessons/' . $lessonId);
        } else {
            return abort(404, trans('text.learned_all_category'));
        }

    }

    public function shuffleOptions($lessonWordId)
    {
        $options = explode(',', $lessonWordId->word->word_options);
        $options = array_add($options, '', $lessonWordId->word->japanese_words);
        shuffle($options);
        return $options;
    }

    public function showResults(Lesson $lesson)
    {
        $lessonResults = LessonWord::where('lesson_id', $lesson->id)->with('word')->get();
        return view('lesson.result', compact('lessonResults', 'lesson'));
    }

}
