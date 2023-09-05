<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Observe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * View Functions
     */
    public function index(){
        $accept = Observe::where('status','accept')->count();
        $pending = Observe::where('status','pending')->count();
        $admins = DB::table('role_user')->where('role_id',2)->count();
        $analytic = DB::table('role_user')->where('role_id',3)->count();
        return view('dashboard.index',['accept'=>$accept,'pending'=>$pending,'admins'=>$admins,'analytic'=>$analytic]);
    }
}
