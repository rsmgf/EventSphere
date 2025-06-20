@extends('template')

@section('title', 'Beranda - EventSphere')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="great-vibes-font">Welcome To EventSphere!</h1>
    </div>

    <h2 class="h3">Event Sedang Berlangsung</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="eventGrid">
        @foreach ($events as $event)
            <div class="col">
            <div class="card h-100 event-card shadow-sm">
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top"
                    alt="Konser Musik Akbar" height="200">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                    <p class="card-text small text-muted"><i class="bi bi-geo-alt me-1"></i>{{ \Illuminate\Support\Str::limit($event->location, 40) }}</p>
                    <p class="card-text small text-muted"><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($event['start_date'])->format('d-m-Y') }}</p>
                    <p class="card-text small text-muted">Pendaftar: {{ $event->bookings_count}}</p>
                    <p class="card-text small text-muted">Harga: {{ $event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 mb-3">
                    <a href="{{ route('event_detail',  ['slug' => $event->slug]) }}" class="btn btn-primary w-100">Detail Event</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
