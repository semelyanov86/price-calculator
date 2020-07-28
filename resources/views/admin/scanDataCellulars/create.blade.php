@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.scanDataCellular.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.scan-data-cellulars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.scanDataCellular.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="html">{{ trans('cruds.scanDataCellular.fields.html') }}</label>
                <textarea class="form-control {{ $errors->has('html') ? 'is-invalid' : '' }}" name="html" id="html" required>{{ old('html') }}</textarea>
                @if($errors->has('html'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.html_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="html_changed_datetime">{{ trans('cruds.scanDataCellular.fields.html_changed_datetime') }}</label>
                <input class="form-control datetime {{ $errors->has('html_changed_datetime') ? 'is-invalid' : '' }}" type="text" name="html_changed_datetime" id="html_changed_datetime" value="{{ old('html_changed_datetime') }}">
                @if($errors->has('html_changed_datetime'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_changed_datetime') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.html_changed_datetime_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider_name">{{ trans('cruds.scanDataCellular.fields.provider_name') }}</label>
                <input class="form-control {{ $errors->has('provider_name') ? 'is-invalid' : '' }}" type="text" name="provider_name" id="provider_name" value="{{ old('provider_name', '') }}">
                @if($errors->has('provider_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provider_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.provider_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_name">{{ trans('cruds.scanDataCellular.fields.package_name') }}</label>
                <input class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" type="text" name="package_name" id="package_name" value="{{ old('package_name', '') }}">
                @if($errors->has('package_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_change_price">{{ trans('cruds.scanDataCellular.fields.package_change_price') }}</label>
                <input class="form-control {{ $errors->has('package_change_price') ? 'is-invalid' : '' }}" type="number" name="package_change_price" id="package_change_price" value="{{ old('package_change_price', '') }}" step="0.01">
                @if($errors->has('package_change_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_change_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_change_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="parser">{{ trans('cruds.scanDataCellular.fields.parser') }}</label>
                <input class="form-control {{ $errors->has('parser') ? 'is-invalid' : '' }}" type="text" name="parser" id="parser" value="{{ old('parser', '') }}" required>
                @if($errors->has('parser'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parser') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.parser_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_month_price">{{ trans('cruds.scanDataCellular.fields.package_month_price') }}</label>
                <input class="form-control {{ $errors->has('package_month_price') ? 'is-invalid' : '' }}" type="number" name="package_month_price" id="package_month_price" value="{{ old('package_month_price', '') }}" step="0.01">
                @if($errors->has('package_month_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_month_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_month_price_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('html_changed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="html_changed" value="0">
                    <input class="form-check-input" type="checkbox" name="html_changed" id="html_changed" value="1" {{ old('html_changed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="html_changed">{{ trans('cruds.scanDataCellular.fields.html_changed') }}</label>
                </div>
                @if($errors->has('html_changed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_changed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.html_changed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_min_lines">{{ trans('cruds.scanDataCellular.fields.package_min_lines') }}</label>
                <input class="form-control {{ $errors->has('package_min_lines') ? 'is-invalid' : '' }}" type="number" name="package_min_lines" id="package_min_lines" value="{{ old('package_min_lines', '') }}" step="1">
                @if($errors->has('package_min_lines'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_min_lines') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_min_lines_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_minutes">{{ trans('cruds.scanDataCellular.fields.package_minutes') }}</label>
                <input class="form-control {{ $errors->has('package_minutes') ? 'is-invalid' : '' }}" type="number" name="package_minutes" id="package_minutes" value="{{ old('package_minutes', '') }}" step="1">
                @if($errors->has('package_minutes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_minutes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_minutes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_sms">{{ trans('cruds.scanDataCellular.fields.package_sms') }}</label>
                <input class="form-control {{ $errors->has('package_sms') ? 'is-invalid' : '' }}" type="number" name="package_sms" id="package_sms" value="{{ old('package_sms', '') }}" step="1">
                @if($errors->has('package_sms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_sms') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_sms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_gb">{{ trans('cruds.scanDataCellular.fields.package_gb') }}</label>
                <input class="form-control {{ $errors->has('package_gb') ? 'is-invalid' : '' }}" type="number" name="package_gb" id="package_gb" value="{{ old('package_gb', '') }}" step="1">
                @if($errors->has('package_gb'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_gb') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_gb_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_sim_price">{{ trans('cruds.scanDataCellular.fields.package_sim_price') }}</label>
                <input class="form-control {{ $errors->has('package_sim_price') ? 'is-invalid' : '' }}" type="number" name="package_sim_price" id="package_sim_price" value="{{ old('package_sim_price', '') }}" step="0.01">
                @if($errors->has('package_sim_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_sim_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_sim_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_sim_connection_price">{{ trans('cruds.scanDataCellular.fields.package_sim_connection_price') }}</label>
                <input class="form-control {{ $errors->has('package_sim_connection_price') ? 'is-invalid' : '' }}" type="number" name="package_sim_connection_price" id="package_sim_connection_price" value="{{ old('package_sim_connection_price', '') }}" step="0.01">
                @if($errors->has('package_sim_connection_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_sim_connection_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.scanDataCellular.fields.package_sim_connection_price_helper') }}</span>
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