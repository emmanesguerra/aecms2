<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeRequest extends FormRequest
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
            'address' => 'required',
            'contact_person' => 'max:191',
            'telephone' => 'max:100',
            'mobile' => 'max:100',
            'email' => 'max:100',
            'marker' => 'required',
            'store_hours' => '',
        ];
    }
}
