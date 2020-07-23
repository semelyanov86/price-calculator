@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.scanQueue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.scan-queues.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="scan_url">{{ trans('cruds.scanQueue.fields.scan_url') }}</label>
                <input class="form-control {{ $errors->has('scan_url') ? 'is-invalid' : '' }}" type="text" name="scan_url" id="scan_url" value="{{ old('scan_url', '') }}" required>
                @if($errors->has('scan_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.scan_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scan_parameters">{{ trans('cruds.scanQueue.fields.scan_parameters') }}</label>
                <input class="form-control {{ $errors->has('scan_parameters') ? 'is-invalid' : '' }}" type="text" name="scan_parameters" id="scan_parameters" value="{{ old('scan_parameters', '') }}">
                @if($errors->has('scan_parameters'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_parameters') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.scan_parameters_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('scan_finished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="scan_finished" value="0">
                    <input class="form-check-input" type="checkbox" name="scan_finished" id="scan_finished" value="1" {{ old('scan_finished', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="scan_finished">{{ trans('cruds.scanQueue.fields.scan_finished') }}</label>
                </div>
                @if($errors->has('scan_finished'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_finished') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.scan_finished_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scan_datetime">{{ trans('cruds.scanQueue.fields.scan_datetime') }}</label>
                <input class="form-control datetime {{ $errors->has('scan_datetime') ? 'is-invalid' : '' }}" type="text" name="scan_datetime" id="scan_datetime" value="{{ old('scan_datetime') }}">
                @if($errors->has('scan_datetime'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_datetime') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.scan_datetime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="request">{{ trans('cruds.scanQueue.fields.request') }}</label>
                <input class="form-control {{ $errors->has('request') ? 'is-invalid' : '' }}" type="text" name="request" id="request" value="{{ old('request', '') }}">
                @if($errors->has('request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.request_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_code">{{ trans('cruds.scanQueue.fields.response_code') }}</label>
                <input class="form-control {{ $errors->has('response_code') ? 'is-invalid' : '' }}" type="number" name="response_code" id="response_code" value="{{ old('response_code', '') }}" step="1">
                @if($errors->has('response_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.response_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="response_html">{{ trans('cruds.scanQueue.fields.response_html') }}</label>
                <textarea class="form-control {{ $errors->has('response_html') ? 'is-invalid' : '' }}" name="response_html" id="response_html">{{ old('response_html') }}</textarea>
                @if($errors->has('response_html'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_html') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.response_html_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.scanQueue.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ScanQueue::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', 'none') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proxy_id">{{ trans('cruds.scanQueue.fields.proxy') }}</label>
                <select class="form-control select2 {{ $errors->has('proxy') ? 'is-invalid' : '' }}" name="proxy_id" id="proxy_id">
                    @foreach($proxies as $id => $proxy)
                        <option value="{{ $id }}" {{ old('proxy_id') == $id ? 'selected' : '' }}>{{ $proxy }}</option>
                    @endforeach
                </select>
                @if($errors->has('proxy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proxy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanQueue.fields.proxy_helper') }}</span>
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