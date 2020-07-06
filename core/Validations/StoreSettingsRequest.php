<?php

namespace Core\Validations;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsRequest extends FormRequest
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
            'domain_name' => 'required|max:191',
            'website_name' => 'required|max:191',
            'owner' => 'max:191',
            'meta_title' => 'required|max:191',
            'meta_description' => 'required',
            'meta_keywords' => '',
            'timezone' => 'required|max:191',
            'developer' => 'required|max:191'
        ];
    }
}
