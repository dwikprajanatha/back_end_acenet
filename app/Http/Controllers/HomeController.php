<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->segment(2) == "instalasiBaru") {
            $route = "instalasiBaru";
        } else if ($request->segment(2) == "maintenance") {
            $route = "maintenance";
        } else if ($request->segment(2) == "pencabutan") {
            $route = "pencabutan";
        }

        return redirect()->route($route);
    }
}
