<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'name' => 'bail|required|min:2|max:100',
            'avatar' => 'image:mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_height=120,min_width=120',
            'locale' => [
                'required',
                Rule::in(array_keys(User::LOCALES)),
            ]
        ];
    }
}
