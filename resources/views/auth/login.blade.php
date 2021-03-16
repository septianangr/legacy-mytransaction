<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $site_name }} - Halaman Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('assets/build/css/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/image/icon/default.png') }}" rel="icon">
</head>

<body class="text-center font-weight-light">
    <form class="form-signin" id="form-signin" action="javascript:void(0)">
        <a href="#">
            <img class="pl-3" src="{{ asset('assets/image/icon/default.png') }}" width="100" height="100">
        </a>
        <h1 class="h3 mt-1 font-weight-light">{{ $site_name }}</h1>
        <p>
            Silahkan login untuk melanjutkan
        </p>
        <div class="form-group">
            <div class="input-group">
                <input type="email" class="form-control font-weight-light" id="email" placeholder="Alamat Email" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="password" class="form-control font-weight-light" id="password" placeholder="Password" required>
            </div>
        </div>
        <div class="checkbox mb-3 font-weight-light">
            <label>
                <input name="remember" type="checkbox" id="remember" value="remember"> Ingat saya
            </label>
        </div>
        <button class="btn btn-primary btn-block" id="btn-submit" type="submit">LOGIN</button>
        @if ($registration == 1)
        <p class="mt-4">
            <a class="text-link text-underline" href="{{ route('register.index') }}">Daftar Akun Baru</a>
        </p>
        @endif
        <p class="mt-5 mb-3 text-muted">
            <small>
                Dibuat dengan <i class="fa fa-heart text-danger"></i>
                <br />
                &copy; {{ date('Y') }} <a class="text-muted" href="mailto:nugrahas1499@gmail.com" target="_blank">Septiana Nugraha</a>
            </small>
        </p>
    </form>

    <script>
        APP_URL = "{{ route('auth.login') }}";
    </script>
    <script src="{{ asset('assets/vendor/jquery/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/font-awesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/build/js/auth.login.js') }}"></script>

</body>

</html>