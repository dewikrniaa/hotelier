@extends('layouts.app-master')

@section('content')
    @auth
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body">
                                <h4 class="">Tambah Check In</h4>
                                <form action="{{ route('checkin.store') }}" method="POST">
                                    @csrf

                                    {{-- PILIH PELANGGAN --}}
                                    <div class="form-group mb-3">
                                        <label>Nama Pelanggan</label>
                                        <select name="id_pelanggan"
                                            class="form-control @error('id_pelanggan') is-invalid @enderror" required>
                                            <option value="">-- Pilih Pelanggan --</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}"
                                                    {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PILIH TIPE KAMAR --}}
                                    <div class="form-group mb-3">
                                        <label>Tipe Kamar</label>
                                        <select id="tipe_kamar" class="form-control" required>
                                            <option value="">-- Pilih Tipe Kamar --</option>
                                            @foreach ($kamar->groupBy('nama_tipe') as $tipe => $list)
                                                <option value="{{ $tipe }}" data-harga="{{ $list->first()->harga }}">
                                                    {{ $tipe }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- PILIH KAMAR TERSEDIA --}}
                                    <div class="form-group mb-3">
                                        <label>Nomor Kamar</label>
                                        <select name="id_kamar" id="id_kamar"
                                            class="form-control @error('id_kamar') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kamar --</option>
                                            @foreach ($kamar as $k)
                                                <option value="{{ $k->id_kamar }}" data-tipe="{{ $k->nama_tipe }}">
                                                    {{ $k->no_kamar }} ({{ $k->nama_tipe }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CHECK IN DATE --}}
                                    <div class="form-group mb-3">
                                        <label>Tanggal Check In</label>
                                        <input type="date" name="checkin_date"
                                            class="form-control @error('checkin_date') is-invalid @enderror" required>
                                        @error('checkin_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CHECK OUT DATE --}}
                                    <div class="form-group mb-3">
                                        <label>Tanggal Check Out</label>
                                        <input type="date" name="checkout_date"
                                            class="form-control @error('checkout_date') is-invalid @enderror" required>
                                        @error('checkout_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- HARGA --}}
                                    <div class="form-group mb-4">
                                        <label>Harga per Malam</label>
                                        <input type="text" id="harga" class="form-control" readonly
                                            placeholder="Pilih tipe kamar">
                                    </div>

                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('checkin.index') }}" class="btn btn-secondary">Kembali</a>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            {{-- SCRIPT FILTER KAMAR + AUTO HARGA --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const tipeSelect = document.getElementById('tipe_kamar');
                    const kamarSelect = document.getElementById('id_kamar');
                    const hargaInput = document.getElementById('harga');

                    tipeSelect.addEventListener('change', function() {
                        const tipe = this.value;
                        const harga = this.options[this.selectedIndex].dataset.harga;

                        hargaInput.value = harga ?
                            'Rp ' + Number(harga).toLocaleString('id-ID') :
                            '';

                        Array.from(kamarSelect.options).forEach(opt => {
                            if (!opt.value) return;
                            opt.hidden = opt.dataset.tipe !== tipe;
                        });

                        kamarSelect.value = '';
                    });
                });
            </script>

            </body>
        @endauth
    @endsection
