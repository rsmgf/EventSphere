@extends('user.template')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        {{-- <h1 class="h2">Detail Event {{ $event['nama'] }}</h1> --}}
    </div>
    <div id="pageContentContainer">
        <div id="detailEventContent" class="page-section">
            {{-- <div class="event-hero-section" style="background-image: url('{{ $event['image'] }}');"> --}}
            </div>

            <div class="event-details-body">
                <div class="container mb-3 border-bottom">
                    <h2 class="mb-3 h3">Deskripsi</h2>
                    {{-- <p>{{ $event['deskripsi'] }}</p> --}}

                    <h2 class="h3 mt-4 mb-3">Jadwal</h3>
                    <div class="event-meta-item">
                        <i class="bi bi-calendar3"></i>
                        <span>
                            {{-- <strong>Tanggal: </strong>{{ $event['tanggal_mulai']->dayName }}, {{ $event['tanggal_mulai']->isoFormat('DD-MMMM-YYYY') }} --}}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <i class="bi bi-clock"></i>
                        {{-- <span><strong>Pukul:</strong> {{ $event['waktu_mulai']->isoFormat('HH:mm') }} - {{ $event['waktu_selesai']->isoFormat('HH:mm') }}</span> --}}
                    </div>
                    <div class="event-meta-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span><strong>Lokasi:</strong> Gelora Bung Karno Stadium, Jakarta</span>
                    </div>

                    <h2 class="h3 mt-4 mb-3">Syarat & Ketentuan</h3>
                    {{-- <ul>
                        @foreach ($event['syarat_ketentuan'] as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul> --}}

                    <h2 class="h3 mt-4 mb-3">Tempat / Platform</h3>
                    {{-- <p>{{ $event['tempat_platform'] }}</p> --}}

                </div>
                <div class="d-flex justify-content-center">
                    {{-- <a href="{{ route('guest.daftar_event') }}"> --}}
                        <button type="button" class="btn btn-primary">Daftar Sekarang</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
