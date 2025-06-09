<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;


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
        return view('home');
    }

    public function proteksi_1_admin()
    {
        echo "Ini adalah halaman yang terproteksi nomor 1 admint";
    }

     public function proteksi_1_user()
    {
        echo "Ini adalah halaman yang terproteksi nomor 1 user";
    }

    public function userHome()
    {
        $events = Event::where('start_date', '>=', now())
                   ->orderBy('start_date', 'asc')
                   ->take(6)
                   ->get();
        return view('user.home', compact('events'));
    }

}
