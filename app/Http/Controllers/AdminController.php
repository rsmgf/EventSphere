<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizer;

class AdminController extends Controller
{
    //EVENT
     // Tampilkan dashboard ke admin
    public function adminDashboard()
    {
        $bookings = Booking::with('event')->latest()->take(5)->get();
        $events = Event::withcount('bookings')
                   ->where('start_date', '>=', now())
                   ->orderBy('start_date', 'asc')
                   ->take(2)
                   ->get();
                   
        return view('admin.dashboard', compact('events', 'bookings'));
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
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;

        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event-images', 'public');
        };
        
        $event = new Event($data);
        $event->save();
        return redirect()->route('admin.events_list')->with('success', 'Event berhasil dibuat.');
    }


    public function edit(Event $event)
    {
        // Ambil semua organizer untuk pilihan dropdown misalnya
        $organizers = Organizer::all();

        return view('admin.edit_event', compact('event', 'organizers'));
    }


    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'start_time' => 'nullable',
        'end_time' => 'nullable',
        'location' => 'required|string|max:255',
        'max_tickets' => 'required|integer|min:1',
        'sk' => 'nullable|string',
        'harga' => 'nullable|numeric|min:0',
        'pemateri' => 'nullable|string|max:255',
        'organizer_id' => 'nullable|exists:organizers,id',
    ]);

    if ($request->input('title') !== $event->title) {
        $slug = Str::slug($request->input('title'));
        $count = \App\Models\Event::where('slug', $slug)->where('id', '!=', $event->id)->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $validated['slug'] = $slug;
    }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');         
            $validated['image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('admin.events_list')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if ($event->image && Storage::exists('public/' . $event->image)) {
        Storage::delete('public/' . $event->image);
        }


        $event->delete();

        return redirect()->route('admin.events_list')->with('success', 'Event berhasil dihapus.');
    }


    public function adminEvents()
    {
        $events = Event::withcount('bookings')
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);
        return view('admin.events', compact('events'));
    }

    public function showDetail($slug)
    {
        $event = Event::with('organizer')->where('slug', $slug)->firstOrFail();
        return view('admin.event_detail', compact('event'));
    }

    //Pendaftar
     // Admin: melihat siapa yang daftar
    public function showPendaftaran(Event $event)
    {
        $registrants = $event->bookings()->get();
        return view('admin.user_daftar', compact('event', 'registrants'));
    }


    // Admin: update status
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled',
        ]);

         $booking->update([
        'status' => $request->input('status'),
        ]);

        return back()->with('success', 'Status booking diperbarui.');
    }

    public function semuaBooking()
    {
        $bookings = Booking::with('event')->latest()->paginate(10);
        return view('admin.daftar_booking', compact('bookings'));
    }


    //Penyelenggara
    // Tampilkan daftar semua organizer
    public function org_index()
    {
        $organizers = Organizer::all();
        return view('admin.data_organizer', compact('organizers'));
    }

    // Edit form
    public function org_edit(Organizer $organizer)
    {
        return view('admin.edit_organizer', compact('organizer'));
    }

    // Update organizer
    public function org_update(Request $request, Organizer $organizer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'payment_account' => 'nullable|string|max:255',
        ]);

        $organizer->update($request->only(['name', 'instagram', 'twitter', 'payment_account']));

        return redirect()->route('admin.org_list')->with('success', 'Organizer berhasil diperbarui.');
    }

    // Hapus organizer
    public function org_destroy(Organizer $organizer)
    {
        $organizer->delete();
        return redirect()->route('admin.org_list')->with('success', 'Organizer berhasil dihapus.');
    }

    public function org_create()
    {
        return view('admin.tambah_organizer');
    }

    public function org_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'payment_account' => 'nullable|string|max:255',
        ]);

        Organizer::create($request->only(['name', 'instagram', 'twitter', 'website', 'payment_account']));

        return redirect()->route('admin.org_create')->with('success', 'Penyelenggara berhasil ditambahkan!');
    }

}
