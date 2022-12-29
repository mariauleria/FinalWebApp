<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Seblhaire\DateRangePickerHelper\DateRangePickerHelper;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($p)
    {
        $current_date_time = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $current_date_time = $current_date_time->format('Y-m-d H:i:s');

//        kalau tgl bookingnya dah lewat (book date < current) otomatis ke reject
        DB::table('requests')
            ->where('status', '=', 'waiting approval')
            ->where('requests.book_date', '<=', $current_date_time)
            ->update(['status' => 'rejected']);

        if($p == 'student'){
            $user_id = \Illuminate\Support\Facades\Auth::user()->id;
            $data = \App\Models\Request::where('user_id', $user_id)->get();
            $approver = null;
        }
        else if($p == 'admin'){
            $user_div_id = \Illuminate\Support\Facades\Auth::user()->division->id;
            $data = DB::table('requests')
                ->where('status', '=', 'waiting approval')
                ->orWhere('status', '=', 'approved')
                ->orWhere('status', '=', 'on use')
                ->join('users', 'requests.user_id', '=', 'users.id')
                ->select('requests.*', 'users.id AS userid', 'users.name', 'users.binusianid')
                ->where('users.division_id', '=', $user_div_id)
                ->get();
            $approver = \Illuminate\Support\Facades\Auth::user()->division->approver;
        }
        else if($p == 'approver'){
            // TODO: data yg dikirim ke approver apa aja

        }
        return view($p . '.home', [
            'data' => $data,
            'approver' => $approver
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        return view('student/checkRequest');
    }

    public function createRequestDetail(Request $request){
        $res = $request->input('datetimes');
        $res = explode(" - ", $res);
        $book_date = strtotime($res[0]);
        $return_date = strtotime($res[1]);

//        dd($book_date, $return_date);

        $user_div_id = \Illuminate\Support\Facades\Auth::user()->division->id;
        $assets = DB::table('assets')
            ->join('asset_categories', 'assets.asset_category_id', '=', 'asset_categories.id')
            ->select('assets.*', 'asset_categories.name')
            ->where('status', 'tersedia')
            ->where('division_id', '=', $user_div_id)
            ->get();

        $avail_items = array();

        foreach ($assets as $asset){
            $id = $asset->id;
            $bookings = DB::table('bookings')
                ->join('requests', 'bookings.request_id', '=', 'requests.id')
                ->select('requests.book_date', 'requests.return_date')
                ->where('bookings.asset_id', '=', $id)
                ->where('requests.status', '!=', 'rejected')
                ->get();

            if($bookings->isEmpty()){
                array_push($avail_items, $asset);
            }
            else{
                $available = true;
                foreach ($bookings as $booking){
                    $test_book_date = strtotime($booking->book_date);
                    $test_return_date = strtotime($booking->return_date);

                    if($book_date > $test_return_date || $return_date < $test_book_date){
                        $available = true;
                    }
                    else{
                        $available = false;
                        break;
                    }
                }
                if($available){
                    array_push($avail_items, $asset);
                }
            }
        }

        return view('student/createRequest', [
            'book_date' => $book_date,
            'return_date' => $return_date,
            'assets' => $avail_items,
        ]);
    }

    public function create(Request $request)
    {
        $return_date = $request->input('return_date');
        $book_date = $request->input('book_date');
        $assets = $request->input('assets');

        return view('student/createRequestDetail', [
            'assets' => $assets,
            'book_date' => $book_date,
            'return_date' => $return_date
        ]);
    }

    public function confirm(Request $request){

        $assets = unserialize($request->input('assets'));
        $bookings = array();

        foreach ($assets as $i){
            $asset = DB::table('assets')
                ->join('asset_categories', 'assets.asset_category_id', '=', 'asset_categories.id')
                ->select('assets.*', 'asset_categories.name')
                ->where('assets.id', '=', $i)
                ->get();
            foreach ($asset as $a){
                array_push($bookings, $a);
            }
        }

        if($request->input('new-lokasi') != null){
            $lokasi = $request->input('new-lokasi');
        }
        else{
            $lokasi = $request->input('lokasi');
        }
        $purpose = $request->input('purpose');
        $return_date = $request->input('return_date');
        $book_date = $request->input('book_date');

        return view('student/confirmRequest', [
            'assets' => $bookings,
            'book_date' => $book_date,
            'return_date' => $return_date,
            'purpose' => $purpose,
            'lokasi' => $lokasi
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
        $data = $request->input();
        $request = new \App\Models\Request();

        $request->purpose = $data['purpose'];
        $request->lokasi = $data['lokasi'];
        $request->user_id = Auth::user()->id;

        $request->book_date = date("Y-m-d H:i:s", strtotime($data['book_date']));
        $request->return_date = date("Y-m-d H:i:s", strtotime($data['return_date']));

        $request->save();

        return DB::table('requests')->max('id');

//        dd($request->purpose, $request->lokasi, $request->user_id, $request->book_date, $request->return_date);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_div_id = \Illuminate\Support\Facades\Auth::user()->division->id;
        $data = DB::table('requests')
            ->where('status', '=', 'done')
            ->orWhere('status', '=', 'rejected')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->select('requests.*', 'users.id AS userid', 'users.name', 'users.binusianid')
            ->where('users.division_id', '=', $user_div_id)
            ->get();
        return view('admin.historiRequest', [
            'data' => $data
        ]);
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
    public function update(Request $request)
    {
        $req = \App\Models\Request::find($request->request_update_id);
        if($request->request_update == 'rejected'){
            $req->status = $request->request_update;
            $req->update();
            $message = 'Request berhasil ditolak.';
        }
        elseif ($request->request_update == 'approved'){
            $req->track_approver++;
            $approver = $request->approver_num;

            if($req->track_approver == $approver){
                $req->status = $request->request_update;
            }
            $req->update();
            $message = 'Request berhasil diapprove.';
        }
        return redirect('dashboard/admin')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
//        DONE: ini gimana yak delete requestny pas cancel?
        $request = \App\Models\Request::find($id->request_delete_id);
        if($request->status == 'waiting approval'){

            $bookings = new BookingController();
            $bookings->destroy($id->request_delete_id);

            $request->delete();
            $message = 'Request peminjaman berhasil dihapus';
        }
        else{
            $message = 'Request peminjaman tidak bisa dicancel karena sudah diapprove admin.';
        }
        return redirect('dashboard/student')->with('message', $message);
    }
}
