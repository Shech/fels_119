<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Category;
use App\Models\Word;
use App\Repositories\Contracts\WordRepositoryInterface as WordRepository;

class WordController extends Controller
{
    protected $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function create()
    {
        $categories = Category::lists('name', 'id');
        $countOfOption = Word::OPTION_COUNT;
        return view('word.create', compact('categories', 'countOfOption'));
    }

    public function index()
    {
        $words = Word::all();
        $categories = Category::lists('name');
        return view('word.index', compact('words', 'categories'));
    }

    public function store(WordRequest $request)
    {
        $this->wordRepository->createOrUpdateWord($request);
        return redirect('words');
    }

    public function edit(Word $word)
    {
        $categories = Category::lists('name', 'id');
        $wordOptions = array(explode(',', $word->word_options));
        $countOfOption = Word::OPTION_COUNT;
        return view('word.edit', compact('word', 'countOfOption', 'wordOptions', 'categories'));
    }

    public function update(WordRequest $request, Word $word)
    {
        $this->wordRepository->createOrUpdateWord($request, $word);
        return redirect('words');
    }

    public function destroy(Word $word)
    {
        $word->delete();
        return redirect('words');
    }
}
