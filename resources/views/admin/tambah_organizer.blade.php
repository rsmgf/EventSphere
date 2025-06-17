@extends('admin.template')

@section('title', 'Tambah Penyelenggara - EventSphere')


@section('content')
<h2>Tambah Penyelenggara</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops!</strong> Ada kesalahan saat mengisi form:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.org_store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Organizer</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="instagram" class="form-label">Instagram</label>
        <input type="url" name="instagram" class="form-control" placeholder="https://instagram.com/username" required>
    </div>
    <div class="mb-3">
        <label for="twitter" class="form-label">Twitter</label>
        <input type="url" name="twitter" class="form-control" placeholder="https://twitter.com/username">
    </div>
    <div class="mb-3">
        <label for="payment_account" class="form-label">Nomor Pembayaran</label>
        <input type="text" class="form-control" id="payment_account" name="payment_account" placeholder="12345678910111213">
    </div>

    </div>


    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
