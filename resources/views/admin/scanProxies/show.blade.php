@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.scanProxy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-proxies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scanProxy.fields.id') }}
                        </th>
                        <td>
                            {{ $scanProxy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanProxy.fields.proxy_ip') }}
                        </th>
                        <td>
                            {{ $scanProxy->proxy_ip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanProxy.fields.proxy_port') }}
                        </th>
                        <td>
                            {{ $scanProxy->proxy_port }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-proxies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#proxy_scan_queues" role="tab" data-toggle="tab">
                {{ trans('cruds.scanQueue.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="proxy_scan_queues">
            @includeIf('admin.scanProxies.relationships.proxyScanQueues', ['scanQueues' => $scanProxy->proxyScanQueues])
        </div>
    </div>
</div>

@endsection