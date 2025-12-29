@extends('layouts.app')
@section('title', 'Data Sampah')

@section('content')
<h2 class="mb-4">Data Sampah</h2>
<div class="card shadow-sm border-0 p-3">
    <div class="card-body">
        <!-- Form Pencarian -->
        <form class="d-flex mb-3" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari sampah..." value="{{ request('search') }}">

            @if(auth()->user()->role === 'admin')
            <select name="trashed" class="form-select">
                <option value="">-- Filter Data --</option>
                <option value="only" {{ request('trashed')=='only'?'selected':'' }}>Hapus</option>
                <option value="with" {{ request('trashed')=='with'?'selected':'' }}>Dengan Hapus</option>
                <option value="without" {{ request('trashed')=='without'?'selected':'' }}>Tanpa Hapus</option>
            </select>
            @endif

            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>

        <!-- Tombol Tambah -->
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('sampah.create') }}" class="btn btn-success mb-3">+ Tambah Sampah</a>
        @endif

        <table class="table table-striped-columns table-hover">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>Jenis Sampah</th>
                    <th>Harga per Kg</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                @forelse($sampah as $index => $smp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $smp->jenis_sampah }}</td>
                    <td>{{ number_format($smp->harga_per_kg, 2, ',', '.') }}</td>
                    <td>
                        @if ($smp->is_active)
                        <span class="badge bg-success">Aktif</span>
                        @else
                        <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <!-- tombol lihat detail -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $smp->id }}">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <!-- tombol edit -->
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('sampah.edit', $smp->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>

                        <!-- tombol hapus -->
                        <form action="{{ route('sampah.destroy', $smp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
        @foreach($sampah as $smp)
        <div class="modal fade" id="modalDetail{{ $smp->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $smp->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $smp->id }}">Detail Sampah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Jenis Sampah:</strong> {{ $smp->jenis_sampah ?? '-' }}</p>
                        <p><strong>Harga per Kg:</strong> {{ number_format($smp->harga_per_kg, 2, ',', '.') }}</p>
                        <p><strong>Deskripsi:</strong> {{ $smp->deskripsi ?? '-' }}</p>
                        <p><strong>Status:</strong>
                            @if ($smp->is_active)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </p>
                        <p><strong>Tanggal Input:</strong> {{ $smp->created_at ?? '-' }}</p>
                        <p><strong>Tanggal Update:</strong> {{ $smp->updated_at ?? '-' }}</p>
                        <p><strong>Dihapus:</strong> {{ $smp->deleted_at ?? '-' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
@endsection
