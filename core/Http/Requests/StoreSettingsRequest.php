<?php

namespace Core\Http\Requests;

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
        try
        {
            return Auth::user()->hasPermissionTo('settings-edit', true);
        } catch (\Exception $ex) {
            return abort(403, "Action Denied. This account doesn't have authorization to continue this process.");
        }
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
