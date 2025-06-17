@extends('user.template')

@section('title', 'Riwayat - EventSphere')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat Pendaftaran</h1>
    </div>

    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status</th>
                    <th>Nama Event</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->created_at)->isoFormat('DD MMMM YYYY') }}</td>
                        <td>
                            @if ($booking['status'] == 'confirmed')
                                <span class="badge text-bg-success">Terverifikasi</span>
                            @elseif ($booking['status'] == 'pending')
                                <span class="badge text-bg-warning">Menunggu</span>
                            @elseif ($booking['status'] == 'cancelled')
                                <span class="badge text-bg-danger">Tidak Terverifikasi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.event_detail', ['slug' => $booking->event->slug]) }}">
                                {{ $booking->event->slug }}
                            </a>
                        </td>

                        <td>
                            <a href={{ route('user.detail_pendaftaran', ['id' => $booking->id]) }}>
                                <button type="button" class="btn btn-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
