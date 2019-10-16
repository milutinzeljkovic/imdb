<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieReactionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id' => 'required|exists:movies,id',
            'reaction_id' => 'required|exists:reaction_types,id'
        ];
    }
}
