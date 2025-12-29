@extends('layouts.app')
@section('title', 'edit sampah')

@section('content')
    <h2 class="mb-4">Edit Data Sampah</h2>
    <div class="card shadow-sm border-0 p-3">
        <div class="card-body">
            <form action="{{ route('sampah.update', $sampah->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="jenis_sampah" class="form-label">Jenis Sampah :</label>
                    <input type="text" class="form-control" name="jenis_sampah" id="jenis_sampah" value="{{ $sampah->jenis_sampah }}" required>
                </div>
                <div class=" mb-3">
                    <label for="harga_per_kg" class="form-label">Harga per Kg :</label>
                    <input type="number" class="form-control" name="harga_per_kg" id="harga_per_kg" value="{{ $sampah->harga_per_kg }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi :</label>
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ $sampah->deskripsi }}" required>
                </div>

                <div class="mt-3">
                    <button type="submit" name="submit" class="btn btn-success btn-lg">Edit Data</button>

                    <a href="{{ route('sampah.index') }}" class="btn btn-danger btn-lg">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection