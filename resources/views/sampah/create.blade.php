@extends('layouts.app')
@section('title', 'add sampah')

@section('content')
    <h2 class="mb-4">Tambah Data Sampah</h2>
    <div class="card shadow-sm border-0 p-3">
        <div class="card-body">
            <form action="{{ route('sampah.store') }}" method="POST">
                @csrf

                {{-- Jenis Sampah --}}
                <div class="mb-3">
                    <label for="jenis_sampah" class="form-label">Jenis Sampah :</label>
                    <input type="text" class="form-control" name="jenis_sampah" id="jenis_sampah" placeholder="contoh : Plastik" required>
                </div>
                <div class="mb-3">
                    <label for="harga_per_kg" class="form-label">Harga per Kg :</label>
                    <input type="number" class="form-control" name="harga_per_kg" id="harga_per_kg" placeholder="contoh : 2000" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi :</label>
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="contoh : Botol, Sedotan, Styrofoam dll">
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-lg">Simpan</button>
                <a href="{{ route('sampah.index') }}" class="btn btn-danger btn-lg">Kembali</a>
            </form>
        </div>
    </div>

@endsection