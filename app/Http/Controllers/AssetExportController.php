<?php

namespace App\Http\Controllers;

use App\Exports\AssetExport;
use App\Models\Asset;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AssetExportController extends Controller
{
    public function export(){
        $aset = Asset::select(['id', 'serial_number', 'status', 'brand', 'assigned_location', 'current_location', 'division_id', 'asset_category_id'])->get();
        return Excel::download(new AssetExport($aset), 'rekap_aset.xlsx');
    }
}
