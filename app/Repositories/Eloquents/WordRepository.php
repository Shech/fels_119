<?php
namespace App\Repositories\Eloquents;

use App\Models\UserWord;
use App\Models\Word;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordRepository extends Repository implements WordRepositoryInterface
{
    public function createOrUpdateWord($request, $word = null)
    {
        if (!empty($request->file('sound_file'))) {
            $soundFile = $request->file('sound_file');
            $path = public_path(config('path.sound'));
            $soundName = time() . "." . $soundFile->getClientOriginalExtension();
            $upload = $soundFile->move($path, $soundName);
        } else {
            $soundName = null;
        }
        $soundData = [
            'vietnamese_words' => $request->vietnamese_word,
            'japanese_words' => $request->japanese_word,
            'word_options' => implode(",", $request->word_options),
            'sound_file' => $soundName,
            'category_id' => $request->category_id,
        ];
        if (!empty($word)) {
            $word->update($soundData);
        } else {
            Word::create($soundData);
        }
    }

    public function filterWords($request)
    {
        $userWords = UserWord::where('user_id', auth()->id())->lists('word_id');
        switch ($request->filter) {
            case Word::LEARNED_WORD:
                if (empty($request->category_id)) {
                    return Word::whereIn('id', $userWords)->get();
                } else {
                    return Word::whereIn('id', $userWords)->where('category_id', $request->category_id)->get();
                }
                break;
            case Word::UNLEARNED_WORD:
                if (empty($request->category_id)) {
                    return Word::whereNotIn('id', $userWords)->get();
                } else {
                    return Word::whereNotIn('id', $userWords)->where('category_id', $request->category_id)->get();
                }
                break;
            case Word::ALL_WORD:
                if (empty($request->category_id)) {
                    return Word::all();
                } else {
                    return Word::where('category_id', $request->category_id)->get();
                }
                break;
            default:
                return abort(404, trans('text.undefined'));
        }
    }
}
