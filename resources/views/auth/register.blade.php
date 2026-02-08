<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
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

<style>
.toggle-password {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>


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
                            <h2 class="text-secondary mt-5"><b>Register Here</b></h2>
                            <p class="f-16 mt-2">Enter your credentials to continue</p>
                        </div>

                        <form action="/register" method="post">
                            @csrf
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 bg-light-primary bg-light text-muted">
                                    <img src="../assets/images/authentication/google-icon.svg" alt="image" />Sign In
                                    With Google
                                </button>
                            </div>
                            <div class="saprator mt-3">
                                <span>or</span>
                            </div>
                            <h5 class="my-4 text-center">Sign in with Email address</h5>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Email address" required>
                                <label for="email">Email address</label>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="form-floating mb-3">
                                <input type="name" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- PASSWORD -->
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" required>
                                <label for="password">Password</label>

                                <span class="toggle-password" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>

                            <!-- CONFIRM PASSWORD -->
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password" placeholder="Password Confirmation" required>
                                <label for="confirm_password">Confirm Password</label>

                                <span class="toggle-password" data-target="confirm_password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>

    <script>
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>

</body>

</html>
