@extends('user.template')

@section('title', 'Event Detail')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Detail Event {{ $event['title'] }}</h1>
    </div>
    <div id="pageContentContainer">
        <div id="detailEventContent" class="page-section">
            <div class="event-hero-section" style="background-image: url('{{ asset('storage/' . $event['image']) }}');">
            </div>

            <div class="event-details-body">
                <div class="container mb-3 border-bottom">
                    <h3 class="mb-3 h3">Deskripsi</h3>
                    <p>{{ $event['description'] }}</p>


                    <h3 class="h3 mt-4 mb-3">Jadwal</h3>
                    <div class="event-meta-item">
                        <span>
                            <strong>Tanggal: </strong>{{ \Carbon\Carbon::parse($event->start_date)->dayName }}, {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('DD MMMM YYYY') }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <span><strong>Pukul:</strong> {{\Carbon\Carbon::parse($event->start_time)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($event->end_time)->isoFormat('HH:mm') }}</span>
                    </div>

                    <h3 class="h3 mt-4 mb-3">Syarat & Ketentuan</h3>
                    <pre>{{ $event->sk }}</pre>

                    <h3>Penyelenggara:</h3>
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


                    <h3 class="h3 mt-4 mb-3">Tempat / Platform</h3>
                    <p>{{ $event['location'] }}</p>

                </div>
                <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-primary">Daftar Sekarang</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
