<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\FCM_Push;

class HomeController extends Controller
{

    use FCM_Push;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // if ($request->segment(2) == "instalasiBaru") {
        //     $route = "instalasiBaru";
        // } else if ($request->segment(2) == "maintenance") {
        //     $route = "maintenance";
        // } else if ($request->segment(2) == "pencabutan") {
        //     $route = "pencabutan";
        // }

      

        $arr_device_id = ['c1qfjMT1Tk2lyZJZ3sNdK7:APA91bHKnXqL3xM8jKNtJUQQr4xXXm6k3Rd3vD9dbjyj7ohg2je6ApERAeTPL9EIycS4yyjZI8xCBpU1JmmAn08hY6lHo7mGcyyRknapIy6wr6PBrhwagWOHk0Eg17GUjMMnfO2eCXAx'];

        dd($this->pushNotif($arr_device_id, "Pekerjaan Baru!", "SPK telah ditambahkan, Segera periksa!"));

        return redirect()->route($route);
    }
}
