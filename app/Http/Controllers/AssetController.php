<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Asset::all();
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
            $aset->asset_category_id = $data['asset-category'];
            $aset->division_id = $data['division_id'];
            $aset->save();
            return redirect('admin/searchAsset')->with('status', "Aset berhasil ditambahkan");
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
//        $data = Asset::where('id', $id)->first();
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
        $aset = Asset::find($id);
        $aset->serial_number = $request->input('serialnumber');
        $aset->status = $request->input('asset-status');
        $aset->assigned_location = $request->input('location');
        $aset->brand = $request->input('brand');
        $aset->asset_category_id = $request->input('asset_category');
        $aset->update();
        return redirect('admin/searchAsset')->with('status', 'Aset berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
