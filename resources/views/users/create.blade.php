@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<h2 class="mb-4">Tambah User</h2>

<div class="card shadow-sm border-0 p-3">
    <div class="card-body">

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            @method('POST')

            {{-- ROLE --}}
            <div class="mb-3">
                <label class="form-label">Role User</label>
                <select name="role" class="form-select" required id="roleSelect">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="nasabah">Nasabah</option>
                </select>
            </div>

            {{-- NIN (HANYA NASABAH) --}}
            <div class="mb-3 d-none" id="ninField">
                <label class="form-label">NIN</label>
                <input type="text" class="form-control" name="nin" value="{{ old('nin') }}" placeholder="NIN untuk nasabah" disabled>
            </div>

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>

            {{-- JENIS KELAMIN --}}
            <div class="mb-3">
                <label class="form-label d-block">Jenis Kelamin</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="male" checked>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="female">
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="address" rows="3"></textarea>
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            {{-- USERNAME --}}
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>

            {{-- NO HP --}}
            <div class="mb-3">
                <label class="form-label">No Telephone</label>
                <input type="text" class="form-control" name="phone_number">
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

{{-- SCRIPT --}}
<script>
    const roleSelect = document.getElementById('roleSelect');
    const ninField = document.getElementById('ninField');

    roleSelect.addEventListener('change', function() {
        if (this.value === 'nasabah') {
            ninField.classList.remove('d-none');
        } else {
            ninField.classList.add('d-none');
        }
    });

</script>
@endsection

