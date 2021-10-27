<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleFormRequest extends FormRequest
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
            'code' => 'required|regex:/^[a-zA-Z0-9_\-]*$/|unique:articles,code,' . $this->id,
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:225',
            'body' => 'required',
            'tags' => 'nullable|string'
        ];
    }
}
