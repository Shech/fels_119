<?php
namespace App\Repositories\Eloquents;

use App\Models\Word;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordRepository extends Repository implements WordRepositoryInterface
{
    public function createOrUpdateWord($request, $word = null)
    {
        if (!empty($request->file('sound_file'))) {
            $soundFile = $request->file('sound_file');
            $path = public_path('sounds');
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
}
