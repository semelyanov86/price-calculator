<?php

namespace App\Http\Requests;

use App\ScanQueue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScanQueueRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scan_queue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scan_queues,id',
        ];
    }
}
