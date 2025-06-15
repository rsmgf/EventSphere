@extends('admin.template')

@section('title', 'Edit Penyelenggara - EventSphere')

@section('content')
    <h2>Edit Organizer</h2>

    <form action="{{ route('admin.org_update', $organizer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $organizer->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Instagram</label>
            <input type="text" name="instagram" value="{{ $organizer->instagram }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Twitter</label>
            <input type="text" name="twitter" value="{{ $organizer->twitter }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>No Pembayaran</label>
            <input type="text" name="payment_account" value="{{ $organizer->payment_account }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
