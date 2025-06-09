@extends('admin.template')

@section('content')
<h2>Tambah Event Baru</h2>

<form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Judul Event</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description">Deskripsi</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
        <label for="location">Lokasi</label>
        <input type="text" name="location" class="form-control" required>
    </div>
     <div class="row mb-3">
        <div class="col">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="col">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="start_time">Waktu Mulai</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>
        <div class="col">
            <label for="end_time">Waktu Selesai</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="organizer_id">Penyelenggara</label>
        <select name="organizer_id" class="form-control" required>
            <option value="" disabled selected>Pilih Penyelenggara</option>
            @foreach ($organizers as $organizer)
                <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="pemateri">Nama Pemateri</label>
        <input type="text" name="pemateri" class="form-control">
    </div>

    <div class="mb-3">
        <label for="sk">Syarat dan Ketentuan</label>
        <textarea name="sk" class="form-control" rows="3" placeholder="Syarat dan ketentuan event."></textarea>
    </div>

    <div class="mb-3">
        <label for="harga">Harga Tiket (Rp)</label>
        <input type="number" name="harga" class="form-control" min="0" value="0" required>
    </div>

    <div class="mb-3">
        <label for="max_tickets">Jumlah Tiket</label>
        <input type="number" name="max_tickets" class="form-control" required min="1">
    </div>
    <div class="mb-3">
        <label for="image">Gambar Event</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
