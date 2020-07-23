@can('scan_queue_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.scan-queues.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.scanQueue.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.scanQueue.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-proxyScanQueues">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_parameters') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_finished') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.scan_datetime') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.request') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.response_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.response_html') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.scanQueue.fields.proxy') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scanQueues as $key => $scanQueue)
                        <tr data-entry-id="{{ $scanQueue->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $scanQueue->id ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->scan_url ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->scan_parameters ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $scanQueue->scan_finished ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $scanQueue->scan_finished ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $scanQueue->scan_datetime ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->request ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->response_code ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->response_html ?? '' }}
                            </td>
                            <td>
                                {{ App\ScanQueue::TYPE_SELECT[$scanQueue->type] ?? '' }}
                            </td>
                            <td>
                                {{ $scanQueue->proxy->proxy_ip ?? '' }}
                            </td>
                            <td>
                                @can('scan_queue_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.scan-queues.show', $scanQueue->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('scan_queue_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.scan-queues.edit', $scanQueue->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('scan_queue_delete')
                                    <form action="{{ route('admin.scan-queues.destroy', $scanQueue->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('scan_queue_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.scan-queues.massDestroy') }}",
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
  let table = $('.datatable-proxyScanQueues:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection