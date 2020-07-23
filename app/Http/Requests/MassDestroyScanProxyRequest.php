<?php

namespace App\Http\Requests;

use App\ScanProxy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScanProxyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_proxy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scan_proxies,id',
        ];
    }
}
