@extends('admin.template')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($events as $event)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            <p class="card-text small text-muted">Tanggal: {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</p>
                            <p class="card-text small text-muted">Pendaftar: {{ $event->bookings_count ?? 0 }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ route('admin.event_detail',  ['slug' => $event->slug]) }}" class="btn btn-sm btn-primary w-100">Lihat Detail & Pendaftar</a>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
@endsection
