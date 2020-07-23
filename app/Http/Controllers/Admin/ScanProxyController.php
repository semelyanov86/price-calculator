<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScanProxyRequest;
use App\Http\Requests\StoreScanProxyRequest;
use App\Http\Requests\UpdateScanProxyRequest;
use App\ScanProxy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanProxyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_proxy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanProxies = ScanProxy::all();

        return view('admin.scanProxies.index', compact('scanProxies'));
    }

    public function create()
    {
        abort_if(Gate::denies('scan_proxy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scanProxies.create');
    }

    public function store(StoreScanProxyRequest $request)
    {
        $scanProxy = ScanProxy::create($request->all());

        return redirect()->route('admin.scan-proxies.index');
    }

    public function edit(ScanProxy $scanProxy)
    {
        abort_if(Gate::denies('scan_proxy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scanProxies.edit', compact('scanProxy'));
    }

    public function update(UpdateScanProxyRequest $request, ScanProxy $scanProxy)
    {
        $scanProxy->update($request->all());

        return redirect()->route('admin.scan-proxies.index');
    }

    public function show(ScanProxy $scanProxy)
    {
        abort_if(Gate::denies('scan_proxy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanProxy->load('proxyScanQueues');

        return view('admin.scanProxies.show', compact('scanProxy'));
    }

    public function destroy(ScanProxy $scanProxy)
    {
        abort_if(Gate::denies('scan_proxy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanProxy->delete();

        return back();
    }

    public function massDestroy(MassDestroyScanProxyRequest $request)
    {
        ScanProxy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
