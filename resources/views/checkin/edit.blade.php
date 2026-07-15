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
                                <h4 class="">Edit Check In</h4>
                                <form action="{{ route('checkin.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- PELANGGAN --}}
                                    <div class="form-group mb-3">
                                        <label>Nama Pelanggan</label>
                                        <select name="id_pelanggan"
                                            class="form-control @error('id_pelanggan') is-invalid @enderror" required>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}"
                                                    {{ old('id_pelanggan', $data->id_pelanggan) == $p->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- TIPE KAMAR --}}
                                    <div class="form-group mb-3">
                                        <label>Tipe Kamar</label>
                                        <select id="tipe_kamar" class="form-control" required>
                                            @foreach ($kamar->groupBy('nama_tipe') as $tipe => $list)
                                                <option value="{{ $tipe }}" data-harga="{{ $list->first()->harga }}"
                                                    {{ $list->contains('id_kamar', $data->id_kamar) ? 'selected' : '' }}>
                                                    {{ $tipe }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- NOMOR KAMAR --}}
                                    <div class="form-group mb-3">
                                        <label>Nomor Kamar</label>
                                        <select name="id_kamar" id="id_kamar"
                                            class="form-control @error('id_kamar') is-invalid @enderror" required>
                                            @foreach ($kamar as $k)
                                                <option value="{{ $k->id_kamar }}" data-tipe="{{ $k->nama_tipe }}"
                                                    {{ old('id_kamar', $data->id_kamar) == $k->id_kamar ? 'selected' : '' }}>
                                                    {{ $k->no_kamar }} ({{ $k->nama_tipe }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CHECK IN --}}
                                    <div class="form-group mb-3">
                                        <label>Tanggal Check In</label>
                                        <input type="date" name="checkin_date"
                                            value="{{ old('checkin_date', $data->checkin_date) }}"
                                            class="form-control @error('checkin_date') is-invalid @enderror" required>
                                        @error('checkin_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CHECK OUT --}}
                                    <div class="form-group mb-3">
                                        <label>Tanggal Check Out</label>
                                        <input type="date" name="checkout_date"
                                            value="{{ old('checkout_date', $data->checkout_date) }}"
                                            class="form-control @error('checkout_date') is-invalid @enderror" required>
                                        @error('checkout_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- HARGA --}}
                                    <div class="form-group mb-4">
                                        <label>Harga per Malam</label>
                                        <input type="text" id="harga" class="form-control" readonly>
                                    </div>

                                    <button class="btn btn-primary">Update</button>
                                    <a href="{{ route('checkin.index') }}" class="btn btn-secondary">Kembali</a>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            {{-- SCRIPT FILTER KAMAR + HARGA --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const tipeSelect = document.getElementById('tipe_kamar');
                    const kamarSelect = document.getElementById('id_kamar');
                    const hargaInput = document.getElementById('harga');

                    function updateView() {
                        const tipe = tipeSelect.value;
                        const harga = tipeSelect.options[tipeSelect.selectedIndex].dataset.harga;

                        hargaInput.value = harga ?
                            'Rp ' + Number(harga).toLocaleString('id-ID') :
                            '';

                        Array.from(kamarSelect.options).forEach(opt => {
                            if (!opt.value) return;
                            opt.hidden = opt.dataset.tipe !== tipe;
                        });
                    }

                    updateView();
                    tipeSelect.addEventListener('change', updateView);
                });
            </script>

            </body>
        @endauth
    @endsection
