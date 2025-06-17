@extends('admin.template')

@section('title', 'Data Penyelenggara - EventSphere')

@section('content')
     <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
        <h2 class="h3">Daftar Organizer</h2>
        <a href="{{ route('admin.org_create') }}" class="btn btn-dark">+ Tambah Penyelenggara</a>
     </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Instagram</th>
                    <th scope="col">Twitter</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizers as $organizer)
                    <tr class="">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $organizer['id'] }}</td>
                        <td>{{ $organizer['name'] }}</td>
                        <td>{{ $organizer['instagram'] }}</td>
                        <td>{{ $organizer['twitter'] }}</td>
                        <td>{{ $organizer['payment_account'] }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('admin.org_edit', $organizer->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.org_delete', $organizer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
