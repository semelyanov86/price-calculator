<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScanDataCellularRequest;
use App\Http\Requests\UpdateScanDataCellularRequest;
use App\Http\Resources\Admin\ScanDataCellularResource;
use App\ScanDataCellular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScanDataCellularApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scan_data_cellular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanDataCellularResource(ScanDataCellular::all());
    }

    public function store(StoreScanDataCellularRequest $request)
    {
        $scanDataCellular = ScanDataCellular::create($request->all());

        return (new ScanDataCellularResource($scanDataCellular))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ScanDataCellular $scanDataCellular)
    {
        abort_if(Gate::denies('scan_data_cellular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScanDataCellularResource($scanDataCellular);
    }

    public function update(UpdateScanDataCellularRequest $request, ScanDataCellular $scanDataCellular)
    {
        $scanDataCellular->update($request->all());

        return (new ScanDataCellularResource($scanDataCellular))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ScanDataCellular $scanDataCellular)
    {
        abort_if(Gate::denies('scan_data_cellular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scanDataCellular->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
