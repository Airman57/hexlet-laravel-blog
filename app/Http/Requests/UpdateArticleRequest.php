<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $rules = [
            'name' => 'required|unique:articles,name,',
            'body' => 'required|min:5',
        ];

        if($request->isMethod('PATCH'))
        {
        $rules['name'] = 'required|unique:articles,name,' . $request->id;
        }
    return $rules;
    }
}
