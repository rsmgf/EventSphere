@extends('admin.template')

@section('title', 'Daftar Booking - EventSphere')


@section('content')
    <h2 class="h3 mt-3">Daftar Booking Event: {{ $event->title }}</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrants as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->nama }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->nomor_hp }}</td>
                        <td>
                            @if ($booking->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
                            @else
                                <span class="text-muted">Gratis</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.booking_updateStatus', $booking->id) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ 'confirmed' }}">
                                <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                            </form>
                            <form action="{{ route('admin.booking_updateStatus', $booking->id) }}" method="POST" class="mt-1">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ 'cancelled' }}">
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
