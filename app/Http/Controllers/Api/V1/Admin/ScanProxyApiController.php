<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScanProxyRequest;
use App\Http\Requests\UpdateScanProxyRequest;
use App\Http\Resources\Admin\ScanProxyResource;
use App\ScanProxy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanProxyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_proxy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanProxyResource(ScanProxy::all());
    }

    public function store(StoreScanProxyRequest $request)
    {
        $scanProxy = ScanProxy::create($request->all());

        return (new ScanProxyResource($scanProxy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ScanProxy $scanProxy)
    {
        abort_if(Gate::denies('scan_proxy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanProxyResource($scanProxy);
    }

    public function update(UpdateScanProxyRequest $request, ScanProxy $scanProxy)
    {
        $scanProxy->update($request->all());

        return (new ScanProxyResource($scanProxy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ScanProxy $scanProxy)
    {
        abort_if(Gate::denies('scan_proxy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanProxy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
