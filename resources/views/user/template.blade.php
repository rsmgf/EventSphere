<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Home - EventSphere')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons (Opsional, untuk ikon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden; /* Mencegah scroll horizontal yang tidak diinginkan */
        }

        :root {
            --sidebar-width: 280px;
            --navbar-height: 56px; /* Sesuaikan dengan tinggi navbar */
        }

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100; /* Di atas konten lain */
            padding-top: var(--navbar-height); /* Memberi ruang untuk topbar jika topbar juga fixed dan full width */
            background-color: #343a40; /* Warna sidebar (dark) */
            color: #adb5bd;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Untuk sidebar yang menutupi topbar (lebih umum) */
        .sidebar-alt {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030; /* Di atas navbar */
            background-color: #212529; /* Warna sidebar (sangat dark) */
            color: #adb5bd;
            transition: transform 0.3s ease-in-out;
            padding-top: 1rem; /* Padding atas untuk logo/judul */
        }

        .sidebar-alt .nav-link {
            color: #adb5bd;
        }

        .sidebar-alt .nav-link:hover,
        .sidebar-alt .nav-link.active {
            color: #fff;
            background-color: #495057;
        }

        .sidebar-alt .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
            color: #6c757d;
            padding: .5rem 1rem;
        }


        .top-navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width); /* Default untuk layar besar */
            z-index: 99; /* Di bawah sidebar jika sidebar menutupinya */
            height: var(--navbar-height);
            transition: left 0.3s ease-in-out;
        }

        .main-content {
            margin-left: var(--sidebar-width); /* Default untuk layar besar */
            padding-top: var(--navbar-height);
            padding: 1.5rem;
            padding-top: calc(var(--navbar-height) + 1.5rem); /* padding-top ditambah padding umum */
            min-height: calc(100vh - var(--navbar-height)); /* Mengisi sisa tinggi viewport */
            transition: margin-left 0.3s ease-in-out;
            width: calc(100% - var(--sidebar-width)); /* Untuk memastikan lebar konten tepat */
        }

        /* Gaya untuk sidebar yang bisa di-toggle (responsive) */
        @media (max-width: 991.98px) { /* Target layar di bawah lg */
            .sidebar-alt {
                transform: translateX(-100%); /* Sembunyikan sidebar ke kiri */
                z-index: 1040; /* Pastikan di atas backdrop */
            }
            .sidebar-alt.active {
                transform: translateX(0); /* Tampilkan sidebar */
            }
            .top-navbar {
                left: 0; /* Top navbar full width */
            }
            .main-content {
                margin-left: 0; /* Konten full width */
                width: 100%;
            }
            /* Jika sidebar aktif di layar kecil, konten bisa digeser atau diberi backdrop */
            /* body.sidebar-active .main-content {
                margin-left: var(--sidebar-width);
            } */
        }

        .sidebar-brand-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Backdrop untuk sidebar di layar kecil */
        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1035; /* Di bawah sidebar, di atas konten */
            display: none; /* Sembunyikan default */
        }
        .sidebar-alt.active ~ .sidebar-backdrop {
            display: block;
        }

        .great-vibes-font {
            font-family: 'Great Vibes', cursive;
        }

        .event-hero-section {
            height: 45vh; /* Tinggi hero section */
            min-height: 300px; /* Tinggi minimal */
            background-size: cover;
            background-position: center center;
            position: relative;
            display: flex;
            align-items: flex-end; /* Konten di bawah hero */
            color: white;
            padding-top: var(--navbar-height); /* Agar konten tidak tertutup navbar fixed */
        }
        .event-hero-section::before { /* Overlay gelap agar teks lebih terbaca */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .event-hero-content {
            position: relative; /* Agar di atas overlay */
            z-index: 1;
            padding-bottom: 2rem; /* Jarak dari bawah hero */
        }
        .event-hero-content .event-title-hero {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }
        .event-hero-content .event-subtitle-hero {
            font-size: 1.2rem;
        }

        .event-details-body {
            background-color: #fff; /* Latar putih untuk konten detail */
            padding: 2rem 0; /* Padding atas dan bawah untuk section detail */
            margin-top: -50px; /* Tarik konten ke atas sedikit, menimpa hero */
            /* border-radius: .5rem .5rem 0 0; Rounded corner atas */
            position: relative; /* Agar bisa di atas hero */
            z-index: 2; /* Di atas hero section sedikit */
            box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
        }
        .event-meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        .event-meta-item i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
            color: var(--bs-primary); /* Warna ikon primer */
        }
        .event-action-card {
            position: sticky;
            top: calc(var(--navbar-height) + 1.5rem); /* Navbar height + padding */
            background-color: #f8f9fa; /* Latar yang sedikit berbeda */
            border: 1px solid #dee2e6;
        }
        .event-price {
            font-size: 1.75rem;
            font-weight: bold;
        }
    </style>

</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebarMenu" class="sidebar-alt d-flex flex-column p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none justify-content-center">
            {{-- <i class="bi bi-calendar3-event me-2 fs-4"></i> --}}
            <span class="sidebar-brand-text">EventSphere</span>
        </a>
        <hr class="text-secondary">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('user.home') }}" class="nav-link text-white {{ request()->routeIs('user.home')  ? 'active' : '' }}">
                {{-- <a href="/guest/asdfb" class="nav-link text-white {{ request()->routeIs('guest.index')  ? 'active' : '' }}"> --}}
                    <i class="bi bi-house-door me-2"></i>
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('user.events_list') }}" class="nav-link text-white {{ request()->routeIs('user.events_list')  ? 'active' : '' }}" class="nav-link text-white">
                    <i class="bi bi-calendar-event me-2"></i>
                    Daftar Event
                </a>
            </li>
            <li>
                <a href="{{ route('user.booking_list') }}" class="nav-link text-white {{ request()->routeIs('user.booking_list')  ? 'active' : '' }}" class="nav-link text-white">
                    <i class="bi bi-clock-history me-2"></i>
                    Riwayat
                </a>
            </li>
            <li>
                <a href="{{ route('user.bookmarked') }}" class="nav-link text-white {{ request()->routeIs('user.bookmarked')  ? 'active' : '' }}" class="nav-link text-white">
                    <i class="bi bi-bookmark-fill me-2"></i>
                    Bookmark
                </a>
            </li>
            <li>
                <a href="{{ route('user.liked') }}" class="nav-link text-white {{ request()->routeIs('user.liked')  ? 'active' : '' }}" class="nav-link text-white">
                    <i class="bi bi-heart-fill me-2"></i>
                    Liked Event
                </a>
            </li>
            <li>
                <a href="{{ route('user.info') }}" class="nav-link text-white {{ request()->routeIs('user.info')  ? 'active' : '' }}" class="nav-link text-white">
                    <i class="bi bi-info-circle me-2"></i>
                    Tentang Kami
                </a>
            </li>
        </ul>
        {{-- <hr class="text-secondary">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/32" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>User Name</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div> --}}
    </nav>

    <!-- Backdrop untuk sidebar di layar kecil (ketika aktif) -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Main Area: Top Bar + Content -->
    <div class="main-wrapper">
        <!-- Top Bar (Navbar) -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom top-navbar">
            <div class="container-fluid">
                <!-- Tombol Toggle Sidebar untuk layar kecil -->
                <button class="btn btn-outline-secondary d-lg-none me-2" type="button" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

                {{-- <a class="navbar-brand" href="#">Halaman Utama</a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Notifikasi <span class="badge bg-danger">4</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ Auth::check() ? Auth::user()->name : '' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container-fluid">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap Bundle JS (Popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebarMenu');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            // const mainContent = document.querySelector('.main-content'); // Tidak digunakan jika hanya overlay
            // const topNavbar = document.querySelector('.top-navbar'); // Tidak digunakan jika hanya overlay

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    // Untuk menggeser konten jika sidebar tidak overlay
                    // document.body.classList.toggle('sidebar-active');

                    // Toggle backdrop
                    if (sidebar.classList.contains('active')) {
                        sidebarBackdrop.style.display = 'block';
                    } else {
                        sidebarBackdrop.style.display = 'none';
                    }
                });
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    // document.body.classList.remove('sidebar-active');
                    this.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
