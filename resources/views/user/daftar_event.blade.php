@extends('user.template')

@section('title','Mendaftar ' . $event->title . ' - EventSphere')

@section('content')
<div class="container mt-5">
    <h3>Form Pendaftaran untuk: <strong>{{ $event->title }}</strong></h3>

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

    <form action="{{ route('user.booking_store', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Aktif</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP / WhatsApp</label>
            <input type="text" name="nomor_hp" class="form-control" required>
        </div>

        @if($event->harga > 0)
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" required>
        </div>
        @endif

        <button type="submit" class="btn btn-success">Daftar Sekarang</button>
    </form>
</div>
@endsection
