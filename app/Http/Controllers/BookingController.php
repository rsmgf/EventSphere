<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // User: mendaftar ke event
    public function store(Event $event)
    {
        // Cek apakah kuota sudah penuh
        if ($event->bookings()->count() >= $event->max_participants) {
            return back()->with('error', 'Kuota event sudah penuh.');
        }

        // Cek apakah user sudah mendaftar
        $alreadyBooked = Booking::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Kamu sudah mendaftar event ini.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
        ]);

        return back()->with('success', 'Pendaftaran berhasil!');
    }

    // Admin: melihat siapa yang daftar ke event
    public function showPendaftaran(Event $event)
    {
        $registrants = $event->bookings()->with('user')->get();
        return view('admin.user_daftar', compact('event', 'registrants'));
    }

    public function updateStatus(Request $request, Booking $booking) 
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        $booking->status = $request->status;
        $booking->save();
        return back()->with('success', 'Status diperbarui.');
    }


}
