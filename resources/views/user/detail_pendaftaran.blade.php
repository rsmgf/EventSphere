@extends('user.template')

@section('title','Detail Pendaftaran ' . $event->title . ' - EventSphere')


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pendaftaran</h1>
    </div>

    <div id="pageContentContainer">
        <div id="detailEventContent" class="page-section">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 p-2">
                        <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded" alt="Poster Event">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title">{{ $event['title'] }}</h1>
                            <div class="event-meta-item mb-2">
                                <i class="bi bi-calendar3"></i>
                                <span>
                                    <strong>{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('l') }}</strong>,
                                    {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('DD MMMM YYYY') }} -
                                    <strong>{{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('l') }}</strong>,
                                    {{ \Carbon\Carbon::parse($event->end_date)->isoFormat('DD MMMM YYYY') }}
                                </span>
                            </div>
                            <div class="event-meta-item mb-2">
                                <i class="bi bi-clock"></i>
                                <span>
                                    {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                </span>
                            </div>
                            <div class="event-meta-item mb-2">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $event['location'] ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body mb-3">
                    <form method="POST" action="#">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="{{ $pendaftaran['nama'] ?? '' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $pendaftaran['email'] ?? '' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP / WhatsApp</label>
                            <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp"
                                value="{{ $pendaftaran['nomor_hp'] ?? '' }}" readonly>
                        </div>

                        {{-- Uncomment if you want a submit action --}}
                        {{-- <div>
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
