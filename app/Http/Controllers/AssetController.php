<?php

namespace App\Http\Controllers;

use App\Exports\AssetExport;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\DeletedAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Asset::all();
        return view('admin.searchAsset', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $show = AssetCategory::all();
        return View::make('admin.createAsset', [
            'show' => $show
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialnumber' => 'required',
            'location' => 'required',
            'brand' => 'required'
        ]);

        if($validator->fails()){
            return redirect('admin/createAsset')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            //store
            $data = $request->input();
            $aset = new Asset;
            $aset->serial_number = $data['serialnumber'];
            $aset->brand = $data['brand'];
            $aset->assigned_location = $data['location'];
            $aset->current_location = $data['location'];

            if($data['new-asset-category'] != null){
                $new_category = new AssetCategoryController();
                $new_cat_id = $new_category->store($data['new-asset-category']);

                $aset->asset_category_id = $new_cat_id;
            }
            else{
                $aset->asset_category_id = $data['asset-category'];
            }

            $aset->division_id = $data['division_id'];
            $aset->save();
            return redirect('admin/searchAsset')->with('message', "Aset Berhasil Ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Asset::find($id);
        $show = AssetCategory::all();
        return View::make('admin.editAsset', [
            'data' => $data,
            'show' => $show
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'serialnumber' => 'required',
            'location' => 'required',
            'brand' => 'required',
            'asset-status' => 'required',
            'asset_category' => 'required'
        ]);

        if($validator->fails()){
            return redirect('admin/editAsset')
                ->withErrors($validator)
                ->withInput();
        }
        else {
            $aset = Asset::find($id);
            $aset->serial_number = $request->input('serialnumber');
            $aset->status = $request->input('asset-status');
            $aset->assigned_location = $request->input('location');
            $aset->brand = $request->input('brand');
            $aset->asset_category_id = $request->input('asset_category');
            $aset->update();
            return redirect('admin/searchAsset')->with('message', 'Aset Berhasil Diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aset = Asset::find($request->asset_delete_id);
        $d_aset = new DeletedAssetController();
        $d_aset->store($aset);

        $aset->delete();
        return redirect('admin/searchAsset')->with('message', 'Aset Berhasil Dihapus');

    }

    /**
     * Export database table to excel .xlsx file
     *
     * @return \Illuminate\Http\Response
     */
    public function export(){
        $aset = DB::table('assets')
            ->join('divisions', 'assets.division_id', '=', 'divisions.id')
            ->join('asset_categories', 'assets.asset_category_id', '=', 'asset_categories.id')
            ->select('assets.id', 'assets.serial_number', 'assets.status', 'assets.brand', 'assets.assigned_location', 'assets.current_location', 'divisions.name as divisi', 'asset_categories.name as jenis')
            ->get();

        return Excel::download(new AssetExport($aset), 'rekap_aset.xlsx');
    }
}
