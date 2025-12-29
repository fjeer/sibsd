@extends('layouts.app')
@section('title', 'Laporan Setoran')

@section('content')
<h2 class="mb-3">Laporan Setoran Sampah</h2>

<div class="card shadow-sm border-0 p-3">
    <div class="card-body">

        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Nasabah</label>
                <select name="id_nasabah" class="form-select">
                    <option value="">Semua</option>
                    @foreach($nasabahs as $n)
                    <option value="{{ $n->id }}" {{ request('id_nasabah') == $n->id ? 'selected' : '' }}>
                        {{ $n->profile->full_name ?? '-' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Jenis Sampah</label>
                <select name="id_sampah" class="form-select">
                    <option value="">Semua</option>
                    @foreach($sampahs as $s)
                    <option value="{{ $s->id }}" {{ request('id_sampah') == $s->id ? 'selected' : '' }}>
                        {{ $s->jenis_sampah }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">Tampilkan</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nasabah</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($setoran as $row)
                    <tr>
                        <td>{{ $row->tanggal_transaksi }}</td>
                        <td>{{ $row->nasabah->profile->full_name ?? '-' }}</td>
                        <td>{{ $row->sampah->jenis_sampah ?? '-' }}</td>
                        <td>{{ number_format($row->berat, 2) }}</td>
                        <td>{{ number_format($row->total_poin, 0) }}</td>
                    </tr>
                    @endforeach

                    <tr class="table-secondary fw-bold">
                        <td colspan="3" class="text-end">Total</td>
                        <td>{{ number_format($totalBerat, 2) }}</td>
                        <td>{{ number_format($totalPoin, 0) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection