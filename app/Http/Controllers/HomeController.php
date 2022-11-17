<?php

namespace App\Http\Controllers;

use App\Models\RolePageMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //TO DO: validate other user
        $res = $this->validateUser(1);
        if($res->count() == 0){
            return view('admin.home');
        }
        else{
            return view('home');
        }
    }

    public function validateUser(int $page_id){
        $user_role_id = Auth::user()->role->id;
        $role = RolePageMapping::where('role_id', $user_role_id)->where('page_id', $page_id)->get();

        return $role;
    }
}
