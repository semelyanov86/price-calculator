<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDataApiRequest extends FormRequest
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
            'choosedCompany' => 'required|exists:scan_data_cellulars,provider_name',
            'type' => 'required',
            'lines' => 'required|numeric',
            'gb' => 'required|array',
            'minutes' => 'required|array',
            'phone' => 'required|array',
            'roaming' => 'required|array',
            'sms' => 'required|array'
        ];
    }
}
