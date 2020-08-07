<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'id' => 'required',
            'title' => 'required',
            'template' => 'required',
            'contents.*.name' => 'required_without:contents.*.selected_panel',
            'contents.*.selected_panel' => 'sometimes|required',
        ];
    }
}
