@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1>Profil Pengguna</h1>
            <p>Informasi akun dan detail profil Anda.</p>

            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Akun</h5>
                    <p><strong>Nama Pengguna:</strong> {{ Auth::user()->username }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Peran:</strong> {{ Auth::user()->role }}</p>
                </div>
            </div>
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Profil</h5>
                    @if(Auth::user()->profile)
                        <p><strong>Nama Lengkap:</strong> {{ Auth::user()->profile->full_name }}</p>
                        <p><strong>Alamat:</strong> {{ Auth::user()->profile->address }}</p>
                        <p><strong>Nomor Telepon:</strong> {{ Auth::user()->profile->phone_number }}</p>
                        <p><strong>Tempat Lahir:</strong> {{ Auth::user()->profile->birth_place }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ Auth::user()->profile->birth_date }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ Auth::user()->profile->gender }}</p>
                    @else
                        <p>Profil belum lengkap. Silakan perbarui profil Anda.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
