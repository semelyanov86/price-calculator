@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.scanDataCellular.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-data-cellulars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.id') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.date') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->html }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html_changed_datetime') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->html_changed_datetime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.provider_name') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->provider_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_name') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_change_price') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_change_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.parser') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->parser }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_month_price') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_month_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html_changed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $scanDataCellular->html_changed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_min_lines') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_min_lines }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_minutes') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_minutes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sms') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_sms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_gb') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_gb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sim_price') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_sim_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sim_connection_price') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->package_sim_connection_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.minutes_to_other_countries') }}
                        </th>
                        <td>
                            {{ $scanDataCellular->minutes_to_other_countries }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scan-data-cellulars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection