@extends('user.template')

@section('title',  $event->title .' - EventSphere')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Event {{ $event['title'] }}</h1>
    </div>
    <div id="pageContentContainer">
        <div id="detailEventContent" class="page-section">
            <div class="event-hero-section" style="background-image: url('{{ asset('storage/' . $event['image']) }}');">
            </div>

            <div class="event-details-body">
                <div class="container mb-3 border-bottom">
                    <h2 class="mb-3 h4">Deskripsi</h2>
                    <p>{{ $event['description'] }}</p>


                    <h2 class="h4 mt-4 mb-3">Jadwal</h4>
                    <div class="event-meta-item">
                        {{-- <i class="bi bi-calendar3"></i> --}}
                        <span>
                            <strong>Tanggal: </strong>{{ \Carbon\Carbon::parse($event->start_date)->dayName }}, {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('DD MMMM YYYY') }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        {{-- <i class="bi bi-clock"></i> --}}
                        <span><strong>Pukul:</strong> {{\Carbon\Carbon::parse($event->start_time)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($event->end_time)->isoFormat('HH:mm') }}</span>
                    </div>
                    {{-- <div class="event-meta-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span><strong>Lokasi:</strong> Gelora Bung Karno Stadium, Jakarta</span>
                    </div> --}}

                    <h2 class="h4 mt-4 mb-3">Syarat & Ketentuan</h4>
                    <pre>{{ $event->sk }}</pre>
                    
                    <h2 class="h4 mt-4 mb-3">Sisa tiket</h2>
                    <p>{{ $event->max_tickets - $event->bookings->count() }}</p>

                    <h2>Penyelenggara:</h2>
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

                    <h2 class="h4 mt-4 mb-3">Tempat / Platform</h4>
                    <p>{{ $event['location'] }}</p>

                </div>
                <div class="d-flex justify-content-center gap-2">
                    {{-- <form action="{{ route('guest.like_event') }}" method="post">
                        @csrf
                        <input type="hidden" name="event_id">
                        <button type="submit" class="btn btn-primary flex items-center">
                            @if ($event['is_like'])
                                <i class="bi bi-heart-fill"></i>
                            @else
                                <i class="bi bi-heart"></i>
                            @endif
                            <span>Like</span>
                        </button>
                    </form> --}}
                    <form action="{{ route('user.like', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ Auth::check() && Auth::user()->likes->contains($event) ? 'btn-danger' : 'btn-outline-danger' }}">
                            @if(Auth::check() && Auth::user()->likes->contains($event))
                                <i class="bi bi-heart-fill"></i>
                                Like
                            @else
                                <i class="bi bi-heart"></i>
                                Like
                            @endif
                        </button>
                    </form>
                        @if ($event->max_tickets <= $event->bookings()->count())
                            <button class="btn btn-secondary" disabled>Tiket Habis</button>
                        @else
                            <a href="{{ route('user.daftar_event', $event->id) }}" class="btn btn-primary">Daftar</a>
                        @endif
                    <form action="{{ route('user.bookmark', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ Auth::check() && Auth::user()->bookmarks->contains($event) ? 'btn-dark' : 'btn-outline-dark' }}">
                            @if(Auth::check() && Auth::user()->bookmarks->contains($event))
                                {{-- State 1: Tampilan jika SUDAH dibookmark --}}
                                <i class="bi bi-bookmark-fill"></i> Bookmark
                            @else
                                {{-- State 2: Tampilan jika BELUM dibookmark --}}
                                <i class="bi bi-bookmark"></i> Bookmark
                            @endif
                        </button>
                    </form>
                    {{-- <form action="{{ route('guest.bookmark_event') }}" method="post">
                        @csrf
                        <input type="hidden" name="event_id">
                        <button type="submit" class="btn btn-primary flex items-center">
                            @if ($event['is_bookmark'])
                                <i class="bi bi-bookmark-fill"></i>
                            @else
                                <i class="bi bi-bookmark"></i>
                            @endif
                            <span>Bookmark</span>
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
