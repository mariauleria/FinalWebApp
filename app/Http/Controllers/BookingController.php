<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_request = new RequestController();
        $request_id = $new_request->store($request);

        $data = $request->input();
        $assets = $data['assets'];

        foreach ($assets as $asset){
            $booking = new Booking();
            $booking->request_id = $request_id;
            $booking->asset_id = $asset;
            $category_id = DB::table('assets')
                ->where('id', '=', $asset)
                ->select('asset_category_id')
                ->get();
            $booking->asset_category_id = $category_id[0]->asset_category_id;
            $booking->save();
        }

        return redirect('dashboard/student')->with('message', "Request Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $id)
    {
        $assets = DB::table('bookings')
            ->join('assets', 'bookings.asset_id', '=', 'assets.id')
            ->join('asset_categories', 'bookings.asset_category_id', '=', 'asset_categories.id')
            ->select('assets.serial_number', 'assets.brand', 'asset_categories.name')
            ->where('bookings.request_id', '=', $id)
            ->get();

        return Redirect::to('dashboard/'. $user . '#see')->with('bookings', $assets);
    }

    public function show2($id)
    {
        $assets = DB::table('bookings')
            ->join('assets', 'bookings.asset_id', '=', 'assets.id')
            ->join('asset_categories', 'bookings.asset_category_id', '=', 'asset_categories.id')
            ->select('assets.serial_number', 'assets.brand', 'asset_categories.name')
            ->where('bookings.request_id', '=', $id)
            ->get();

        return Redirect::to('riwayat#see')->with('bookings', $assets);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('bookings')->where('request_id', '=', $id)->delete();
    }
}
