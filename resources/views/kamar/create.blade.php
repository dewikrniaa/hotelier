@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <h4 class="">Tambah Data Kamar</h4>
                        <form action="{{ route('kamar.store') }}" method="POST">
                            @csrf

                            {{-- NOMOR KAMAR --}}
                            <div class="form-group mb-3">
                                <label>Nomor Kamar</label>
                                <input type="text" name="no_kamar" value="{{ old('no_kamar') }}" maxlength="10"
                                    class="form-control @error('no_kamar') is-invalid @enderror" required>
                                @error('no_kamar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- STATUS --}}
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                    <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>
                                        Maintenance
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TIPE KAMAR --}}
                            <div class="form-group mb-3">
                                <label>Tipe Kamar</label>
                                <select name="tipe_kamar_id" id="tipe_kamar"
                                    class="form-control @error('tipe_kamar_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tipe Kamar --</option>
                                    @foreach ($tipeKamar as $tipe)
                                        <option value="{{ $tipe->id }}" data-harga="{{ $tipe->harga }}"
                                            data-kapasitas="{{ $tipe->kapasitas }}">
                                            {{ $tipe->nama_tipe }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipe_kamar_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- KAPASITAS (READONLY) --}}
                            <div class="form-group mb-3">
                                <label>Kapasitas</label>
                                <input type="text" id="kapasitas" class="form-control" readonly
                                    placeholder="Pilih tipe kamar terlebih dahulu">
                            </div>

                            {{-- HARGA (READONLY) --}}
                            <div class="form-group mb-3">
                                <label>Harga / Malam</label>
                                <input type="text" id="harga" class="form-control" readonly
                                    placeholder="Pilih tipe kamar terlebih dahulu">
                            </div>

                            {{-- BUTTON --}}
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{-- SCRIPT AUTO KAPASITAS & HARGA --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tipeSelect = document.getElementById('tipe_kamar');
                const hargaInput = document.getElementById('harga');
                const kapasitasInput = document.getElementById('kapasitas');

                tipeSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];

                    const harga = selected.dataset.harga;
                    const kapasitas = selected.dataset.kapasitas;

                    if (harga && kapasitas) {
                        hargaInput.value = 'Rp ' + Number(harga).toLocaleString('id-ID');
                        kapasitasInput.value = kapasitas + ' Orang';
                    } else {
                        hargaInput.value = '';
                        kapasitasInput.value = '';
                    }
                });
            });
        </script>
    @endsection
