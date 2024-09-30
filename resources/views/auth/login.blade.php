<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SMIRS Medina</title>

    <link rel="shortcut icon" href="{{ asset('mazer/assets/compiled/svg/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="data:image/png;base64,...(your base64 icon)..." type="image/png" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('mazer//assets/compiled/css/auth.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="{{ asset('mazer/assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Login</h1>
                    <p class="auth-subtitle mb-5">Masukkan Email dan Password Anda</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-xl"
                                placeholder="Email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-xl"
                                placeholder="Password"
                                required
                            />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p>
                            <a class="font-bold" href="auth-forgot-password.html">Lupa Password?</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center; width: 100%;">
                    <img src="{{ asset('mazer/assets/compiled/svg/logo/logo.svg') }}" alt="Logo SMIRS Medina" style="max-width: 100%; height: auto" />
                    <h4 style="margin-top: 30px">Sistem Manajemen Inventaris Rumah Sakit Medina</h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
