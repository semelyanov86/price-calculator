@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.scanQueue.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-queues.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.id') }}
                        </th>
                        <td>
                            {{ $scanQueue->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_url') }}
                        </th>
                        <td>
                            {{ $scanQueue->scan_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_parameters') }}
                        </th>
                        <td>
                            {{ $scanQueue->scan_parameters }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_finished') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $scanQueue->scan_finished ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_datetime') }}
                        </th>
                        <td>
                            {{ $scanQueue->scan_datetime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.request') }}
                        </th>
                        <td>
                            {{ $scanQueue->request }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.response_code') }}
                        </th>
                        <td>
                            {{ $scanQueue->response_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.response_html') }}
                        </th>
                        <td>
                            {{ $scanQueue->response_html }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.type') }}
                        </th>
                        <td>
                            {{ App\ScanQueue::TYPE_SELECT[$scanQueue->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanQueue.fields.proxy') }}
                        </th>
                        <td>
                            {{ $scanQueue->proxy->proxy_ip ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-queues.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection