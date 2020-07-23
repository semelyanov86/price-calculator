<?php

namespace App\Http\Requests;

use App\ScanDataCellular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScanDataCellularRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_data_cellular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scan_data_cellulars,id',
        ];
    }
}
