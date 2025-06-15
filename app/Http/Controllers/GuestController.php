<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class GuestController extends Controller
{
     public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->paginate(12);
        return view('home', compact('events'));
    }

    public function showDetail($slug)
    {
        $event = Event::with('organizer')->where('slug', $slug)->firstOrFail();
        return view('event_detail', compact('event'));
    }

    public function info()
    {
        return view('info');
    }
}
