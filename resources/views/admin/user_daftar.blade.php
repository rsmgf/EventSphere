@extends('admin.template')

@section('content')
    <h1>Daftar Pendaftar untuk: {{ $event->title }}</h1>

    @if ($event->bookings->isEmpty())
        <p>Tidak ada pendaftar.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jumlah Tiket</th>
                    <th>Status</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->num_tickets }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection


<a href="{{ route('admin.user_daftar', $event->id) }}" class="btn btn-info btn-sm">Lihat Pendaftar</a>
