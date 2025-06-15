@extends('admin.template')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
           <a href="{{ route('admin.tambah') }}" class="text-decoration-none">
               <div class="card h-100 event-card shadow-sm">
                   <div class="d-flex align-items-center justify-content-center fw-bold text-bg-secondary"
                       style="height: 200px; font-size:calc(5rem + 1.5vw)">
                       <i class="bi bi-plus"></i>
                   </div>
                   <div class="card-body d-flex align-items-center justify-content-center fw-bold fs-3">
                       Tambah Event
                   </div>
               </div>
           </a>
       </div>
        @foreach ($events as $event)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            <p class="card-text small text-muted">Tanggal: {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</p>
                            <p class="card-text small text-muted">Pendaftar: {{ $event->bookings_count ?? 0 }}</p>
                            <p class="card-text small text-muted">Harga: {{ $event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ route('admin.event_detail',  ['slug' => $event->slug]) }}" class="btn btn-sm btn-primary w-100">Lihat Detail & Pendaftar</a>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
    <br>
    <h3 class="mb-4">Semua Pendaftaran Event</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Event ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Event</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Daftar</th>
                    <th scope="col">Tanggal Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->event->id }}</td>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->event->title ?? '-' }}</td>
                        <td>{{ $booking->nama }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->nomor_hp }}</td>
                        <td>  @if ($booking['status'] === 'confirmed')
                                <span class="badge bg-success">{{ $booking['status'] }}</span>
                            @elseif ($booking['status'] === 'pending')
                                <span class="badge bg-warning">{{ $booking['status'] }}</span>
                            @elseif ($booking['status'] === 'cancelled')
                                <span class="badge bg-danger">{{ $booking['status'] }}</span>
                            @endif</td>
                        <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $booking->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
