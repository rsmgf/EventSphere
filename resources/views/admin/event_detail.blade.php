@extends('admin.template')

@section('title',  $event->title .' - EventSphere')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Detail Event {{ $event['title'] }}</h1>
    </div>
    <div id="pageContentContainer">
        <div id="detailEventContent" class="page-section">
            <div class="event-hero-section" style="background-image: url('{{ asset('storage/' . $event['image']) }}');">
            </div>

            <div class="event-details-body">
                <div class="container mb-3 border-bottom">
                    <h4 class="mb-3 h4">Deskripsi</h4>
                    <p>{{ $event['description'] }}</p>

                    <h4 class="h4 mt-4 mb-3">Jadwal</h4>
                    <div class="event-meta-item">
                        <span>
                            <strong>Tanggal: </strong>{{ \Carbon\Carbon::parse($event->start_date)->dayName }}, {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('DD MMMM YYYY') }} -
                            {{ \Carbon\Carbon::parse($event->end_date)->dayName }}, {{ \Carbon\Carbon::parse($event->end_date)->isoFormat('DD MMMM YYYY') }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <span><strong>Pukul:</strong> {{\Carbon\Carbon::parse($event->start_time)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($event->end_time)->isoFormat('HH:mm') }}</span>
                    </div>

                    <h4 class="h4 mt-4 mb-3">Syarat & Ketentuan</h4>
                    <p>{{ $event->sk }}</p>

                    <h4 class="h4 mt-4 mb-3">Sisa tiket</h4>
                    <p>{{ $event->max_tickets - $event->bookings->count() }}</p>

                    <h4 class="h4 mt-4 mb-3">Pemateri</h4>
                    <p>{{ $event->pemateri}}</p>

                    <h4 class="h4 mt-4 mb-3">Penyelenggara:</h4>
                    <p>{{ $event->organizer->name }}</p>

                    <div class="d-flex gap-2 mt-2">
                        @if ($event->organizer->instagram)
                            <a href="{{ $event->organizer->instagram }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                        @endif

                        @if ($event->organizer->twitter)
                            <a href="{{ $event->organizer->twitter }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-twitter-x"></i> Twitter
                            </a>
                        @endif
                    </div>

                    <h4 class="h4 mt-4 mb-3">Harga</h4>
                    <p>{{ $event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}</p>

                    <h4 class="h4 mt-4 mb-3">Nomor Pembayaran:</h4>
                    <p>{{ $event->organizer->payment_account }}</p>

                    <h4 class="h4 mt-4 mb-3">Tempat / Platform</h4>
                    <p>{{ $event['location'] }}</p>

                </div>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.edit', $event->id) }}">
                        <button type="button" class="btn btn-warning">Edit</button>
                    </a>
                    <a href="{{ route('admin.booking_list', $event->id) }}">
                        <button type="button" class="btn btn-primary">Daftar Pendaftar</button>
                    </a>
                    <form action="{{ route('admin.delete_event', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
