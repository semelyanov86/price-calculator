@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-datas.update", [$userData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.userData.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\UserData::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $userData->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userData.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data">{{ trans('cruds.userData.fields.data') }}</label>
                <textarea class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" name="data" id="data">{{ old('data', $userData->data) }}</textarea>
                @if($errors->has('data'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userData.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scan_data_cellulars_id">{{ trans('cruds.userData.fields.scan_data_cellulars') }}</label>
                <select class="form-control select2 {{ $errors->has('scan_data_cellulars') ? 'is-invalid' : '' }}" name="scan_data_cellulars_id" id="scan_data_cellulars_id">
                    @foreach($scan_data_cellulars as $id => $scan_data_cellulars)
                        <option value="{{ $id }}" {{ ($userData->scan_data_cellulars ? $userData->scan_data_cellulars->id : old('scan_data_cellulars_id')) == $id ? 'selected' : '' }}>{{ $scan_data_cellulars }}</option>
                    @endforeach
                </select>
                @if($errors->has('scan_data_cellulars'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_data_cellulars') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userData.fields.scan_data_cellulars_helper') }}</span>
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