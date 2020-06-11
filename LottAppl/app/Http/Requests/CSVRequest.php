<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CSVRequest extends FormRequest
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
            'file' => 'required|max:2097152|mimes:text/csv'
        ];
    }
    public function message()
    {
        return[
            'file.required' => 'A file is required',
            'file.max' =>'Size must be smaller than 2mb',
            'file.mimes' =>'must be csv'
        ];
    }
}
