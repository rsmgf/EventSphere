<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .link-hover-underline:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center h-100 bg-light">
    <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="text-center mb-3">
                    <h1>EventSphere</h1>
                </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh@email.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center items-center mb-3">
                            <button type="submit" class="btn btn-primary rounded-pill w-50">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none link-hover-underline" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                <div class="d-flex flex-column align-items-center">    
                    <small>
                    <a href="{{ route('register') }}" class="text-decoration-none link-hover-underline">
                            Buat Akun Baru!
                        </a>
                    </small>    
                </div>
            </div>
        </div>
    </div>
</div>
</body>