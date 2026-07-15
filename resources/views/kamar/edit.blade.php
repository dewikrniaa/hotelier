@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <h4 class="">Edit Data Kamar</h4>
                        <form action="{{ route('kamar.update', $data->id_kamar) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- NOMOR KAMAR --}}
                            <div class="form-group mb-3">
                                <label>Nomor Kamar</label>
                                <input type="text" name="no_kamar" value="{{ old('no_kamar', $data->no_kamar) }}"
                                    maxlength="10" class="form-control @error('no_kamar') is-invalid @enderror" required>
                                @error('no_kamar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- STATUS --}}
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="Tersedia"
                                        {{ old('status', $data->status) == 'Tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                    <option value="Maintenance"
                                        {{ old('status', $data->status) == 'Maintenance' ? 'selected' : '' }}>
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
                                    @foreach ($tipeKamar as $tipe)
                                        <option value="{{ $tipe->id }}" data-harga="{{ $tipe->harga }}"
                                            data-kapasitas="{{ $tipe->kapasitas }}"
                                            {{ old('tipe_kamar_id', $data->tipe_kamar_id) == $tipe->id ? 'selected' : '' }}>
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
                                <input type="text" id="kapasitas" class="form-control" readonly>
                            </div>

                            {{-- HARGA (READONLY) --}}
                            <div class="form-group mb-3">
                                <label>Harga / Malam</label>
                                <input type="text" id="harga" class="form-control" readonly>
                            </div>

                            {{-- BUTTON --}}
                            <button class="btn btn-primary">Update</button>
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

                function updateInfo() {
                    const selected = tipeSelect.options[tipeSelect.selectedIndex];

                    const harga = selected.dataset.harga;
                    const kapasitas = selected.dataset.kapasitas;

                    hargaInput.value = harga ?
                        'Rp ' + Number(harga).toLocaleString('id-ID') :
                        '';

                    kapasitasInput.value = kapasitas ?
                        kapasitas + ' Orang' :
                        '';
                }

                // Saat halaman dibuka
                updateInfo();

                // Saat tipe kamar diganti
                tipeSelect.addEventListener('change', updateInfo);
            });
        </script>
    @endsection
