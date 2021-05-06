<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'bail|required|min:5|max:100',
            'content' => 'bail|required|min:10',
            'thumbnail' => 'image:mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_height=200,min_width=200',
        ];
    }
}
