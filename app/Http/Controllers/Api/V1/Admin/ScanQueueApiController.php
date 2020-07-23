<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScanQueueRequest;
use App\Http\Requests\UpdateScanQueueRequest;
use App\Http\Resources\Admin\ScanQueueResource;
use App\ScanQueue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanQueueApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_queue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanQueueResource(ScanQueue::with(['proxy'])->get());
    }

    public function store(StoreScanQueueRequest $request)
    {
        $scanQueue = ScanQueue::create($request->all());

        return (new ScanQueueResource($scanQueue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ScanQueue $scanQueue)
    {
        abort_if(Gate::denies('scan_queue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanQueueResource($scanQueue->load(['proxy']));
    }

    public function update(UpdateScanQueueRequest $request, ScanQueue $scanQueue)
    {
        $scanQueue->update($request->all());

        return (new ScanQueueResource($scanQueue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ScanQueue $scanQueue)
    {
        abort_if(Gate::denies('scan_queue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanQueue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
