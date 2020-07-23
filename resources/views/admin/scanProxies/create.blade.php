@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.scanProxy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.scan-proxies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="proxy_ip">{{ trans('cruds.scanProxy.fields.proxy_ip') }}</label>
                <input class="form-control {{ $errors->has('proxy_ip') ? 'is-invalid' : '' }}" type="text" name="proxy_ip" id="proxy_ip" value="{{ old('proxy_ip', '') }}" required>
                @if($errors->has('proxy_ip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proxy_ip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanProxy.fields.proxy_ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="proxy_port">{{ trans('cruds.scanProxy.fields.proxy_port') }}</label>
                <input class="form-control {{ $errors->has('proxy_port') ? 'is-invalid' : '' }}" type="number" name="proxy_port" id="proxy_port" value="{{ old('proxy_port', '') }}" step="1" required>
                @if($errors->has('proxy_port'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proxy_port') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanProxy.fields.proxy_port_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection