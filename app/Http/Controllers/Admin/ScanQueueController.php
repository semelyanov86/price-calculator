<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScanQueueRequest;
use App\Http\Requests\StoreScanQueueRequest;
use App\Http\Requests\UpdateScanQueueRequest;
use App\ScanProxy;
use App\ScanQueue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanQueueController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_queue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanQueues = ScanQueue::all();

        return view('admin.scanQueues.index', compact('scanQueues'));
    }

    public function create()
    {
        abort_if(Gate::denies('scan_queue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proxies = ScanProxy::all()->pluck('proxy_ip', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.scanQueues.create', compact('proxies'));
    }

    public function store(StoreScanQueueRequest $request)
    {
        $scanQueue = ScanQueue::create($request->all());

        return redirect()->route('admin.scan-queues.index');
    }

    public function edit(ScanQueue $scanQueue)
    {
        abort_if(Gate::denies('scan_queue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proxies = ScanProxy::all()->pluck('proxy_ip', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scanQueue->load('proxy');

        return view('admin.scanQueues.edit', compact('proxies', 'scanQueue'));
    }

    public function update(UpdateScanQueueRequest $request, ScanQueue $scanQueue)
    {
        $scanQueue->update($request->all());

        return redirect()->route('admin.scan-queues.index');
    }

    public function show(ScanQueue $scanQueue)
    {
        abort_if(Gate::denies('scan_queue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanQueue->load('proxy');

        return view('admin.scanQueues.show', compact('scanQueue'));
    }

    public function destroy(ScanQueue $scanQueue)
    {
        abort_if(Gate::denies('scan_queue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanQueue->delete();

        return back();
    }

    public function massDestroy(MassDestroyScanQueueRequest $request)
    {
        ScanQueue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
