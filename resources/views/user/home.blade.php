@extends('user.template')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="great-vibes-font">Welcome To EventSphere{{ Auth::check() ? ', ' . Auth::user()->name . '!' : '!' }}!</h1>
    </div>

    <!-- Isi konten di sini -->
    <h2 class="h3">Event Sedang Berlangsung</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="eventGrid">
        @foreach ($events as $event)
            <div class="col">
            <div class="card h-100 event-card shadow-sm">
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top"
                    alt="Konser Musik Akbar" height="200">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text small text-muted"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event['start_date'])->format('d-m-Y') }}  - {{ $event['location'] }}</p>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 mb-3">
                    <a href="{{ route('user.event_detail',  ['slug' => $event->slug]) }}" class="btn btn-primary w-100">Detail Event</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
