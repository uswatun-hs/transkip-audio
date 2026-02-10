<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
</head>

<body>

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">

                        <a href="#" class="d-flex justify-content-center">
                            <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid brand-logo" />
                        </a>

                        @if (session('failed'))
                            <div class="alert alert-danger text-center mt-3">
                                {{ session('failed') }}
                            </div>
                        @endif

                        <div class="auth-header text-center">
                            <h2 class="text-secondary mt-5"><b>Vrification</b></h2>
                            <p class="f-16 mt-2">Please verify your account</p>
                            <form action="/verify" method="POST">
                                @csrf
                                <input type="hidden" value="register" name="type">
                            <button type="submit" class="btn btn-sm btn-primary">Send OTP to your email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>

</body>

</html>
