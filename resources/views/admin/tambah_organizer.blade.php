@extends('admin.template')

@section('content')
<h2>Tambah Event Baru</h2>

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

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
