<?php

namespace App\Http\Requests;

use App\ScanDataCellular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreScanDataCellularRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_data_cellular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'                  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'html'                  => [
                'required',
            ],
            'html_changed_datetime' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'provider_name'         => [
                'min:2',
                'max:50',
            ],
            'package_name'          => [
                'min:2',
                'max:50',
            ],
            'package_minutes'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'package_sms'           => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'package_gb'            => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'package_month'         => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'package_min_lines'     => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}