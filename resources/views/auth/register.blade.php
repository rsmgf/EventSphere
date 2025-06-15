<!DOCTYPE html>
<html lang="id" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .link-hover-underline:hover {
        text-decoration: underline !important; /* !important untuk memastikan override jika ada konflik */
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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama Anda" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh@mail.com" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" placeholder="Konfirmasi password" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-flex justify-content-center items-center mb-3">
                            <button type="submit" class="btn btn-primary rounded-pill w-50">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                <div class="d-flex flex-column align-items-center">
                    <small>
                        <a href="{{ route('login') }}" class="text-decoration-none link-hover-underline">
                            Sudah Punya Akun?
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</body>