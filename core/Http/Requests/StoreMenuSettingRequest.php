<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMenuSettingRequest extends FormRequest
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
            return Auth::user()->hasPermissionTo('menus-edit', true);
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
            'menu_id' => 'required',
            'main_ul_class' => 'required|max:100',
            'main_li_class' => 'required|max:100',
            'main_anch_class' => 'required|max:100',
            'suc_strt_div' => 'max:150',
            'suc_end_div' => 'max:10',
            'suc_strt_list' => 'max:150',
            'suc_end_list' => 'max:10',
            'suc_anch_class' => 'max:100'
        ];
    }
}
