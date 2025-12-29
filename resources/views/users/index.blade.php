@extends('layouts.app')
@section('title', 'Data Users')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }} - {{ now() }}
</div>
@endif

<h2 class="mb-4">Data User</h2>

<div class="card shadow-sm border-0 p-3">
    <div class="card-body">

        {{-- Form Pencarian --}}
        <form class="d-flex mb-3 gap-2" method="GET" action="{{ route('user.index') }}">
            <input class="form-control" type="search" name="search" placeholder="Cari user..." value="{{ request('search') }}">

            @if(auth()->user()->role === 'admin')
            <select name="role" class="form-select">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                <option value="petugas" {{ request('role')=='petugas'?'selected':'' }}>Petugas</option>
                <option value="nasabah" {{ request('role')=='nasabah'?'selected':'' }}>Nasabah</option>
            </select>
            @endif

            @if(auth()->user()->role === 'admin')
            <select name="trashed" class="form-select">
                <option value="">-- Filter Data --</option>
                <option value="only" {{ request('trashed')=='only'?'selected':'' }}>Hapus</option>
                <option value="with" {{ request('trashed')=='with'?'selected':'' }}>Dengan Hapus</option>
                <option value="without" {{ request('trashed')=='without'?'selected':'' }}>Tanpa Hapus</option>
            </select>
            @endif

            <button class="btn btn-outline-primary">Cari</button>
        </form>

        {{-- Tombol Tambah --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('user.create') }}" class="btn btn-success mb-3">
            + Tambah User
        </a>
        @endif

        <table class="table table-striped-columns table-hover">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>NIN</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody class="table-secondary">
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->profile?->nin ?? '-' }}</td>
                    <td>{{ $user->profile?->full_name ?? '-' }}</td>
                    <td>{{ $user->profile?->phone_number ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $user->id }}">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <!-- tombol edit -->
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>

                        <!-- tombol hapus -->
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

        {{-- Modal Detail --}}
        @foreach($users as $user)
        <div class="modal fade" id="modalDetail{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail User</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>NIN:</strong> {{ $user->profile?->nin ?? '-' }}</p>
                        <p><strong>Nama:</strong> {{ $user->profile?->full_name ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>No HP:</strong> {{ $user->profile?->phone_number ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $user->profile?->address ?? '-' }}</p>
                        <p><strong>Saldo:</strong> {{ $user->profile?->balance ?? 0 }}</p>
                        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                        <p><strong>Status:</strong>
                            {!! $user->is_active
                            ? '<span class="badge bg-success">Aktif</span>'
                            : '<span class="badge bg-secondary">Nonaktif</span>' !!}
                        </p>
                        <p><strong>Tanggal Input:</strong> {{ $user->created_at }}</p>
                        <p><strong>Tanggal Update:</strong> {{ $user->updated_at }}</p>
                        <p><strong>Dihapus:</strong> {{ $user->deleted_at ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
