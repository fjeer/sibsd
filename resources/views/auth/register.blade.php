<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Bank Sampah Digital - Register</title>

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
        <div class="image-section"></div>

        <div class="login-form-section">
            <div class="mb-4 text-center">
                <img src="{{ asset('img/bsd-logo.png') }}" alt="Logo Banksampah Digital" style="max-width: 200px;">
            </div>

            <h2 class="text-center">Daftar Akun Baru</h2>
            <p class="subtitle">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login</a>
            </p>

            <h4 class="text-center">Register</h4>

            {{-- ALERT ERROR --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <hr>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="Nama lengkap" required>
                </div>


                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@example.com" required>
                </div>


                {{-- USERNAME --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username" required>
                </div>


                {{-- NO HP --}}
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="08xxxxxxxxxx" required>
                </div>

                {{-- ADDRESS --}}
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3 password-input-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3 password-input-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Daftar
                    </button>
                </div>
            </form>

            <p class="text-center mt-4">
                Dengan mendaftar, kamu menyetujui
                <a href="#">Syarat Penggunaan</a> dan
                <a href="#">Kebijakan Privasi</a>.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

    </script>

</body>
</html>

