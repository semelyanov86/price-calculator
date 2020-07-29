<?php

namespace App\Http\Controllers;

use App\ScanDataCellular;
use App\UserData;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $companies = ScanDataCellular::all('provider_name', 'id')->unique('provider_name');
        $cellulars = collect([]);
        $ownCellulars = collect([]);
        $id = false;
        $data = json_encode(['lines' => 1]);
        return view('search', compact('companies', 'cellulars', 'ownCellulars', 'id', 'data'));
    }

    public function show(UserData $data)
    {
        $id = $data->id;
        $data = $data->data;
        $filters = json_decode($data, true);
        $lines = $filters['lines'];
        $companies = ScanDataCellular::all('provider_name', 'id')->unique('provider_name');
        $cellulars = collect([]);
        $ownCellulars = collect([]);
        for ($i = 1; $i <= $lines; $i++) {
            $cellularsQuery = ScanDataCellular::select(array('date', 'html_changed_datetime', 'package_change_price', 'package_gb', 'package_min_lines', 'package_minutes', 'package_month_price', 'package_name', 'package_sim_connection_price', 'package_sim_price', 'package_sms', 'id', 'provider_name', 'parser'))->filtering($filters, $i);
            $cellularsQuery->where('provider_name', '!=', $filters['choosedCompany']);
            $cellularsTmp = $cellularsQuery->orderBy('package_month_price')->limit(3)->get();
            $cellulars = $cellulars->merge($cellularsTmp);
        }
        for ($i = 1; $i <= $lines; $i++) {
            $ownCellularsQuery = ScanDataCellular::select(array('date', 'html_changed_datetime', 'package_change_price', 'package_gb', 'package_min_lines', 'package_minutes', 'package_month_price', 'package_name', 'package_sim_connection_price', 'package_sim_price', 'package_sms', 'id', 'provider_name', 'parser'))->filtering($filters, $i);
            $ownCellularsQuery->where('provider_name', '=', $filters['choosedCompany']);
            $ownCellularsTmp = $ownCellularsQuery->orderBy('package_month_price')->limit(1)->get();
            $ownCellulars = $ownCellulars->merge($ownCellularsTmp);
        }

        return view('search', compact('companies', 'cellulars', 'ownCellulars', 'id', 'data'));
    }
}
