<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
    public function index(Request $request)
    {

        // Session::flush();

        $request->session()->flash('error', 'success!');

        return view('admin.dashboard');
    }
}
