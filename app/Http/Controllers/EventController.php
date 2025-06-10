<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizer;

class EventController extends Controller
{
    // Tampilkan semua event ke user
    public function adminDashboard()
    {
        $events = Event::where('start_date', '>=', now())
                   ->orderBy('start_date', 'asc')
                   ->take(3)
                   ->get();
        return view('admin.dashboard', compact('events'));
    }

    public function showPendaftaran($id)
    {
        $event = Event::with('bookings.user')->findOrFail($id);

        return view('admin.user_daftar', compact('event'));
    }

    // Admin: form tambah event
    public function tambah()
    {
        $organizers = Organizer::all();
        return view('admin.tambah', compact('organizers'));
    }

    // Admin: simpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'sk' => 'nullable|string',
            'pemateri' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric|min:0',
            'organizer_id' => 'required|exists:organizers,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'max_tickets' => 'required|integer|min:1',
        ]);
        
        $data = $request->only([
            'title',
            'description',
            'location',
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'sk',
            'pemateri',
            'harga',
            'max_tickets',
            'organizer_id',
        ]);
        
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event-images', 'public');
        };
        
        $event = new Event($data);
        $event->save();
        
        return redirect()->route('admin.events_list')->with('success', 'Event berhasil dibuat.');
    }

    public function adminEvents()
    {
        $events = Event::orderBy('start_date', 'asc')->paginate(12);
        return view('admin.events', compact('events'));
    }

    public function showDetail($slug)
    {
        $event = Event::with('organizer')->where('slug', $slug)->firstOrFail();
        return view('admin.event_detail', compact('event'));
    }

}
