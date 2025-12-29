@extends('layouts.app')
@section('title', 'riwayat setor')

@section('content')
<h2 class="mb-4">Riwayat Setor Sampah</h2>
<div class="card shadow-sm border-0 p-3">
    <div class="card-body"></div>

    <table class="table table-striped-columns table-hover">
        <thead class="table-info">
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Tanggal</th>
                <th>Petugas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            @forelse($setor as $index => $str)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $str->nasabah->profile->full_name ?? '-' }}</td>
                <td>{{ $str->tanggal_transaksi }}</td>
                <td>{{ $str->petugas->profile->full_name ?? '-' }}</td>
                <td>
                    <!-- tombol lihat detail -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $str->id }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    @if(auth()->user()->role === 'admin')
                    <!-- tombol hapus -->
                    <form action="{{ route('setor.destroy', $str->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    Tidak ada data ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Detail -->
    @foreach($setor as $str)
    <div class="modal fade" id="modalDetail{{ $str->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nomor Induk Nasabah:</strong>{{ $str->nasabah->profile?->nin ?? '-' }}</p>
                    <p><strong>Nama Nasabah:</strong>{{ $str->nasabah->profile?->full_name ?? '-' }}</p>
                    <p><strong>Petugas:</strong>{{ $str->petugas->profile?->full_name ?? '-' }}</p>
                    <p><strong>Tanggal Transaksi:</strong>{{ $str->tanggal_transaksi }}</p>
                    <p><strong>Jenis Sampah:</strong>{{ $str->sampah->jenis_sampah }}</p>
                    <p><strong>Berat:</strong>{{ $str->berat }} Kg</p>
                    <p><strong>Total Poin:</strong>{{ $str->total_poin }}</p>
                    <p><strong>Tanggal Input:</strong>{{ $str->created_at }}
                    <p><strong>Tanggal Update:</strong>{{ $str->updated_at }}</p>
                    <p><strong>Dihapus:</strong>{{ $str->deleted_at ?? '-' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
