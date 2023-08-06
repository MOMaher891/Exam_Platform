<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * View Functions
     */
    public function index(){
        return view('dashboard.index');
    }
    public function get_login_form(){
        return view('dashboard.login');
    }

}
