@extends('admin.template')

@section('title', 'Edit Event - EventSphere')

@section('page_style')
<style>
    .image-upload-placeholder {
        background-color: #E9ECEF;
        color: #6c757d;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out, padding 0.15s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 200px;
        overflow: hidden;
    }

    .image-upload-placeholder:hover {
        background-color: #dde1e4;
    }

    .image-upload-placeholder img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 0.375rem;
    }

    .form-label {
        font-weight: 500;
    }

    .card {
        border: 1px solid #dee2e6;
    }

    #placeholderText {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100%;
    }
</style>
@endsection

@section('content')
<h2 class="h3">Edit Event</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.update', $event->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Upload Gambar --}}
            <div class="mb-2">
                <label for="image" class="form-label">Gambar Event</label><br>
                <input type="file" id="image" name="image" accept="image/*" class="form-control">
            </div>

            {{-- Judul Event --}}
            <div class="mb-2">
                <label for="title" class="form-label">Judul Event</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $event->title) }}" required>
            </div>

            {{-- Deskripsi Event --}}
            <div class="mb-2">
                <label for="description" class="form-label">Deskripsi Event</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    required>{{ old('description', $event->description) }}</textarea>
            </div>

            {{-- Lokasi --}}
            <div class="mb-2">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $event->location) }}" required>
            </div>

            {{-- Tanggal Mulai --}}
            <div class="mb-2">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->toDateString()) }}" required>
            </div>

            {{-- Tanggal Berakhir --}}
            <div class="mb-2">
                <label for="end_date" class="form-label">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="end_date" name="end_date"
                    value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->toDateString()) }}" required>
            </div>

            <!-- Waktu mulai -->
            <div class="mb-2">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $event->start_time }}" required>
            </div>

            <!-- Waktu berakhir -->
            <div class="mb-2">
                <label for="end_time" class="form-label">Waktu Berakhir</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $event->end_time }}" required>
            </div>

            <!-- Harga -->
            <div class="mb-2">
                <label for="harga" class="form-label">Harga Tiket (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" min="0" value="{{ $event->harga }}" required>
            </div>

            <!-- Pemateri -->
            <div class="mb-2">
                <label for="pemateri" class="form-label">Pemateri</label>
                <input type="text" class="form-control" id="pemateri" name="pemateri" value="{{ $event->pemateri }}" required>
            </div>

            <!-- Syarat dan Ketentuan -->
            <div class="mb-2">
                <label for="sk" class="form-label">Syarat dan Ketentuan</label>
                <textarea class="form-control" id="sk" name="sk" rows="3">{{ $event->sk }}</textarea>
            </div>

            <!-- Organizer -->
            <div class="mb-2">
                <label for="organizer_id" class="form-label">Organizer</label>
                <select class="form-select" name="organizer_id" id="organizer_id" required>
                    @foreach ($organizers as $organizer)
                        <option value="{{ $organizer->id }}" {{ $organizer->id == $event->organizer_id ? 'selected' : '' }}>
                            {{ $organizer->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Maksimal Pendaftar --}}
            <div class="mb-2">
                <label for="max_tickets" class="form-label">Maksimal Pendaftar</label>
                <input type="number" class="form-control" id="max_tickets" name="max_tickets"
                    value="{{ old('max_tickets', $event->max_tickets) }}" min="1" required>
            </div>

            {{-- Tombol --}}
            <div class="mt-4 text-center">
                <a href="{{ route('admin.events_list') }}" class="btn btn-secondary px-4 py-2">Batal</a>
                <span class="mx-2"></span>
                <button type="submit" class="btn btn-primary px-4 py-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

