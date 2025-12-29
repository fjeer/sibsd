@extends('layouts.app')
@section('title', 'Transaksi Setor')

@section('content')
<h2 class="mb-3">Setor Sampah</h2>

<div class="card shadow-sm border-0 p-3">
    <div class="card-body">

        <form action="{{ route('setor.store') }}" method="POST">
            @csrf

            {{-- NASABAH --}}
            <div class="mb-3">
                <label class="form-label">Nama Nasabah</label>
                <select class="form-select" name="nasabah_id" required>
                    <option value="">-- Pilih Nasabah --</option>
                    @foreach ($nasabah as $nsbh)
                    <option value="{{ $nsbh->id }}">
                        {{ $nsbh->profile->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Setor</label>
                <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}"required>
            </div>

            <hr>
            <h5>Detail Sampah</h5>

            <div id="item_list">
                <div class="row item-row mb-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Jenis Sampah</label>
                        <select class="form-select" name="sampah_id[]" required>
                            <option value="">-- Pilih Sampah --</option>
                            @foreach ($sampah as $smp)
                            <option value="{{ $smp->id }}">
                                {{ $smp->jenis_sampah }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Berat (Kg)</label>
                        <input type="number" step="0.01" min="0" name="berat[]" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-item" style="display:none">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-sm" id="add_item_btn">
                + Tambah Sampah
            </button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('setor.index') }}" class="btn btn-danger">Batal</a>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('add_item_btn').addEventListener('click', function() {
        let item = document.querySelector('.item-row').cloneNode(true);
        item.querySelectorAll('input').forEach(input => input.value = '');
        item.querySelector('.remove-item').style.display = 'inline-block';
        document.getElementById('item_list').appendChild(item);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.item-row').remove();
        }
    });

</script>
@endpush


