<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\Bookmark;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //LIST Event
    public function home()
    {
        $events = Event::withcount('bookings')
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();
        return view('user.home', compact('events'));
    }

    public function info()
    {
        return view('user.info');
    }

    public function userEvents()
    {
        $events = Event::withcount('bookings')
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->paginate(12);
        return view('user.events', compact('events'));
    }

    public function showDetail($slug)
    {
        $event = Event::with('organizer')->where('slug', $slug)->firstOrFail();
        return view('user.event_detail', compact('event'));
    }

    //Like & Bookmark
    public function bookmark(Event $event)
    {
        $user = Auth::user();
        $user->bookmarks()->toggle($event->id);
        return back();
    }

    public function like(Event $event)
    {
        $user = Auth::user();
        $user->likes()->toggle($event->id);
        return back();
    }

    public function bookmarked(){
        $events = Auth::user()->bookmarks()->with('organizer')->get();
        return view('user.bookmarked', compact('events'));
    }

    public function liked(){
        $events = Auth::user()->likes()->with('organizer')->get();
        return view('user.liked', compact('events'));
    }

    //DAFTAR EVENT
    // Menampilkan form pendaftaran
    public function showForm($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Cek kuota
        if ($event->bookings()->count() >= $event->max_tickets) {
            return back()->with('error', 'Tiket sudah habis.');
        }

        return view('user.daftar_event', compact('event'));
    }

    // Menyimpan data pendaftaran
    public function store(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $rules = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_hp' => 'required|string|max:20',
        ];

        if ($event->harga > 0) {
            $rules['bukti_pembayaran'] = 'required|image|mimes:jpg,jpeg,png|max:10240';
        }

        $validated = $request->validate($rules);

        $buktiPath = null;
        if ($event->harga > 0 && $request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'],
            'bukti_pembayaran' => $buktiPath,
            'status' => $event->harga > 0 ? 'pending' : 'confirmed',
        ]);

        return redirect()->route('user.event_detail', $event->slug)->with('success', 'Pendaftaran berhasil!');
    }

    public function userBookings()
    {
        $bookings = Booking::with('event')->where('user_id', Auth::id())->get();
        return view('user.riwayat_daftar', compact('bookings'));
    }

    public function detailPendaftaran($id)
    {
        // Ambil booking berdasarkan ID
        $booking = Booking::with('event')->where('id', $id)->firstOrFail();

        // Ambil event-nya
        $event = $booking->event;

        // Data pemesan
        $pendaftaran = [
            'nama' => $booking->nama,
            'email' => $booking->email,
            'nomor_hp' => $booking->nomor_hp,
        ];

        return view('user.detail_pendaftaran', compact('event', 'pendaftaran'));
    }
}
