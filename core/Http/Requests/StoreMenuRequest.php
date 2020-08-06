<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'nTitle' => 'required_without:pageId|unique:menus,title|max:46',
        ];
    }
    
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'nTitle.required_without' => 'This field is required',
            'nTitle.unique' => 'This title has already been taken',
            'nTitle.max' => 'This title may not be greater than 46 characters',
        ];
    }
}
