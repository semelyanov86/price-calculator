<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScanDataCellularRequest;
use App\Http\Requests\StoreScanDataCellularRequest;
use App\Http\Requests\UpdateScanDataCellularRequest;
use App\ScanDataCellular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanDataCellularController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_data_cellular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanDataCellulars = ScanDataCellular::all();

        return view('admin.scanDataCellulars.index', compact('scanDataCellulars'));
    }

    public function create()
    {
        abort_if(Gate::denies('scan_data_cellular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scanDataCellulars.create');
    }

    public function store(StoreScanDataCellularRequest $request)
    {
        $scanDataCellular = ScanDataCellular::create($request->all());

        return redirect()->route('admin.scan-data-cellulars.index');
    }

    public function edit(ScanDataCellular $scanDataCellular)
    {
        abort_if(Gate::denies('scan_data_cellular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scanDataCellulars.edit', compact('scanDataCellular'));
    }

    public function update(UpdateScanDataCellularRequest $request, ScanDataCellular $scanDataCellular)
    {
        $scanDataCellular->update($request->all());

        return redirect()->route('admin.scan-data-cellulars.index');
    }

    public function show(ScanDataCellular $scanDataCellular)
    {
        abort_if(Gate::denies('scan_data_cellular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scanDataCellulars.show', compact('scanDataCellular'));
    }

    public function destroy(ScanDataCellular $scanDataCellular)
    {
        abort_if(Gate::denies('scan_data_cellular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanDataCellular->delete();

        return back();
    }

    public function massDestroy(MassDestroyScanDataCellularRequest $request)
    {
        ScanDataCellular::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
