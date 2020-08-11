@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-datas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.userData.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\UserData::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', 'none') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <textarea class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" name="data" id="data">{{ old('data') }}</textarea>
                @if($errors->has('data'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userData.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scan_data_cellulars">{{ trans('cruds.userData.fields.scan_data_cellular') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('scan_data_cellulars') ? 'is-invalid' : '' }}" name="scan_data_cellulars[]" id="scan_data_cellulars" multiple>
                    @foreach($scan_data_cellulars as $id => $scan_data_cellular)
                        <option value="{{ $id }}" {{ in_array($id, old('scan_data_cellulars', [])) ? 'selected' : '' }}>{{ $scan_data_cellular }}</option>
                    @endforeach
                </select>
                @if($errors->has('scan_data_cellulars'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan_data_cellulars') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userData.fields.scan_data_cellular_helper') }}</span>
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