<!doctype html>
<html lang="en">

<head>
    <title>Forgot Password</title>
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
                            <h2 class="text-secondary mt-5"><b>Hi, Welcome Back</b></h2>
                            <p class="f-16 mt-2">Enter your email</p>
                        </div>

                        <form action="{{ route('forgot-password-act') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Email address" required>
                                <label for="email">Email address</label>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
