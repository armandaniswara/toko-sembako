<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Laravel 11</title>
    @vite(['resources/js/app.js']) <!-- Bootstrap & app.js via Vite -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
<div class="container mt-5 pb-5" style="max-width: 400px;">
    <h2 class="mb-4">Register</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Password mismatch alert (hidden by default) -->
    <div id="passwordMismatchAlert" class="alert alert-danger d-none" role="alert">
        Passwords do not match.
    </div>

    <form method="POST" action="{{ route('register.submit') }}" id="registerForm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone</label>
            <input type="text"
                   class="form-control @error('telephone') is-invalid @enderror"
                   id="telephone"
                   name="telephone"
                   value="{{ old('telephone') }}"
                   required>
            @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text"
                   class="form-control @error('alamat') is-invalid @enderror"
                   id="alamat"
                   name="alamat"
                   value="{{ old('alamat') }}"
                   required>
            @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1" aria-label="Toggle password visibility">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
                <input type="password"
                       class="form-control"
                       id="password_confirmation"
                       name="password_confirmation"
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation" tabindex="-1" aria-label="Toggle password confirmation visibility">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>

<script>
    // Toggle password visibility
    function togglePasswordVisibility(inputId, toggleBtn) {
        const input = document.getElementById(inputId);
        const icon = toggleBtn.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    document.getElementById('togglePassword').addEventListener('click', function () {
        togglePasswordVisibility('password', this);
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
        togglePasswordVisibility('password_confirmation', this);
    });

    // Validate password match
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const alertBox = document.getElementById('passwordMismatchAlert');

        if (password !== confirmPassword) {
            event.preventDefault();
            alertBox.classList.remove('d-none');
        } else {
            alertBox.classList.add('d-none');
        }
    });
</script>
</body>
</html>
