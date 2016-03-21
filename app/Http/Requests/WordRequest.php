<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vietnamese_word' => 'required',
            'japanese_word' => 'required',
            'word_options' => 'required',
            'sound_file' => 'mimes:mpga',
            'category_id' => 'required',
        ];
    }
}
