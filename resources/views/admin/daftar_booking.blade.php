@extends('admin.template')

@section('title', 'Semua Data Booking - EventSphere')

@section('content')
    <h3 class="mb-4">Semua Pendaftaran Event</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Event ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Event</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Daftar</th>
                    <th scope="col">Tanggal Update</th>
                    <th scope="col">Bukti Pembayaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->event->id }}</td>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->event->title ?? '-' }}</td>
                        <td>  @if ($booking['status'] === 'confirmed')
                                <span class="badge bg-success">{{ $booking['status'] }}</span>
                            @elseif ($booking['status'] === 'pending')
                                <span class="badge bg-warning">{{ $booking['status'] }}</span>
                            @elseif ($booking['status'] === 'cancelled')
                                <span class="badge bg-danger">{{ $booking['status'] }}</span>
                            @endif</td>
                        <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $booking->updated_at->format('d M Y H:i') }}</td>
                        <td>
                            @if ($booking->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
                            @else
                                <span class="text-muted">Gratis</span>
                            @endif
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
