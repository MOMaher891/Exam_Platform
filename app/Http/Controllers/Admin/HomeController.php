<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * View Functions
     * 1) Staff View
     */
    public function index(){
        return view('dashboard.index');
    }

    /**
     *Start Staff View
    */
    public function createStaff(){
        return view('dashboard.staff.create');
    }
    public function editStaff(){
        return view('dashboard.staff.edit');
    }
    /**
     *End Staff View
    */
    /**
     * Functional Functions
     */
    // Staff CRUD functions here...
}
