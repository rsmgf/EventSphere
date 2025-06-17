@extends('user.template')

@section('title', 'Daftar Event - EventSphere')

@section('content')
    <h1 class="mb-4">Daftar Event</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($events as $event)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" height="200">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                        <p class="card-text small text-muted"><i class="bi bi-geo-alt me-1"></i>{{ \Illuminate\Support\Str::limit($event->location, 40) }}</p>
                        <p class="card-text small text-muted"><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</p>
                        <p class="card-text small text-muted"><i class="bi bi-person me-1"></i>Pendaftar: {{ $event->bookings_count}}</p>
                        <p class="card-text small text-muted"><i class="bi bi-cash me-1"></i>{{ $event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('user.event_detail',  ['slug' => $event->slug]) }}" class="btn btn-sm btn-primary w-100">Detail Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
<div class="mt-4 d-flex justify-content-center">
    {{ $events->links('pagination::bootstrap-5') }}
</div>
@endsection
