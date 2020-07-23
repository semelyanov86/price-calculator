<?php

namespace App\Http\Requests;

use App\ScanProxy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreScanProxyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_proxy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'proxy_ip'   => [
                'min:5',
                'max:20',
                'required',
                'unique:scan_proxies',
            ],
            'proxy_port' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
