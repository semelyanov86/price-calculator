@extends('layouts.admin')
@section('content')
@can('scan_data_cellular_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.scan-data-cellulars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.scanDataCellular.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.scanDataCellular.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ScanDataCellular">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html_changed') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.html_changed_datetime') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.provider_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_minutes') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sms') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_gb') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_month') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sim_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_sim_connection_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_min_lines') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanDataCellular.fields.package_change_price') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scanDataCellulars as $key => $scanDataCellular)
                        <tr data-entry-id="{{ $scanDataCellular->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $scanDataCellular->id ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->date ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->html ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->html_changed ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->html_changed_datetime ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->provider_name ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_name ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_minutes ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_sms ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_gb ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_month ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_sim_price ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_sim_connection_price ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_min_lines ?? '' }}
                            </td>
                            <td>
                                {{ $scanDataCellular->package_change_price ?? '' }}
                            </td>
                            <td>
                                @can('scan_data_cellular_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.scan-data-cellulars.show', $scanDataCellular->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('scan_data_cellular_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.scan-data-cellulars.edit', $scanDataCellular->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('scan_data_cellular_delete')
                                    <form action="{{ route('admin.scan-data-cellulars.destroy', $scanDataCellular->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('scan_data_cellular_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.scan-data-cellulars.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ScanDataCellular:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection