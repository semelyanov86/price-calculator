<?php

namespace App\Http\Requests;

use App\ScanQueue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateScanQueueRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_queue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'scan_url'        => [
                'min:10',
                'max:190',
                'required',
            ],
            'scan_parameters' => [
                'min:3',
                'max:190',
            ],
            'scan_datetime'   => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'request'         => [
                'min:5',
                'max:190',
            ],
            'response_code'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tries'           => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
