@extends('layouts.app')
@section('title', 'edit User')

@section('content')
<h2 class="mb-4">Edit User</h2>
<div class="card shadow-sm border-0 p-3">
    <div class="card-body">

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ROLE --}}
            <div class="mb-3">
                <label class="form-label">Role User</label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                    <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
                    <option value="nasabah" {{ $user->role=='nasabah'?'selected':'' }}>Nasabah</option>
                </select>
            </div>

            {{-- NIN (HANYA NASABAH) --}}
            <div class="mb-3">
                <label class="form-label">NIN</label>
                <input type="text" class="form-control" name="nin" value="{{ $user->profile?->nin }}" placeholder="khusus untuk nasabah" disabled>
            </div>

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="full_name" value="{{ $user->profile?->full_name }}" required>
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>

            {{-- USERNAME --}}
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
            </div>

            {{-- NO HP --}}
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control" name="phone_number" value="{{ $user->profile?->phone_number }}">
            </div>

            {{-- ADDRESS --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="address" rows="3">{{ $user->profile?->address }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>

            <a class="btn btn-secondary" href="{{ route('user.index') }}">Kembali</a>
        </form>
    </div>
</div>
@endsection