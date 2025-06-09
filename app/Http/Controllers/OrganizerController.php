<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function create()
    {
        return view('admin.tambah_organizer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
        ]);

        Organizer::create($request->only(['name', 'instagram', 'twitter', 'website']));

        return redirect()->route('admin.org_create')->with('success', 'Penyelenggara berhasil ditambahkan!');
    }
}

