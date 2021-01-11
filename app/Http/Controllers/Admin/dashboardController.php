<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FCM_Push;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
    use FCM_Push;

    public function index(Request $request)
    {
        // Session::flush();
        return view('admin.dashboard');
    }
}
