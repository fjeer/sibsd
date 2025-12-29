<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Bank Sampah Digital - Login</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <div class="image-section">

        </div>
        <div class="login-form-section">
            <div class="mb-4 text-center">
                <img src="{{ asset('img/bsd-logo.png') }}" alt="Logo Banksampah Digital" style="max-width: 200px;">
            </div>

            <h2 class="text-center">Hai, Selamat datang</h2>
            <p class="subtitle">Baru di BSD? <a href="{{ route('register') }}">Daftar Gratis</a></p>
            <h4 class="text-center">Login</h4>
            <!-- Altert -->
            @if (session('loginError'))
            <div class="alert alert-danger">
                {{ session('loginError') }}
            </div>
            @endif
            <!-- End Alert -->
            <hr>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user" class="form-label">Username atau Email</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="username atau email address" required autocomplete="username">
                </div>
                <div class="mb-1 password-input-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                    <label class="form-check-label" for="rememberMe">
                        Remember me
                    </label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
                </div>
            </form>

            <p class="text-center mt-4">
                Dengan melanjutkan, kamu menerima <a href="">Syarat Penggunaan</a> dan <a href="">Kebijakan Privasi</a> kami.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const toggleIcon = passwordField.nextElementSibling.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
