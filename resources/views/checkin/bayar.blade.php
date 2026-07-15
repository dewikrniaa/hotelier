@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            @php
                use Carbon\Carbon;

                $checkin = Carbon::parse($data->checkin_date);
                $checkout = Carbon::parse($data->checkout_date);
                $lamaInap = max(1, $checkin->diffInDays($checkout));
            @endphp

            <div class="card shadow">

                {{-- HEADER --}}
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold">HOTELIER</h4>
                            <small class="text-muted">Invoice Pembayaran</small>
                        </div>
                        <h5 class="text-primary fw-bold">INVOICE</h5>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body">

                    {{-- INFO TAMU --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama Tamu</strong></p>
                            <p>{{ $data->nama }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-1"><strong>No. Kamar</strong></p>
                            <p>{{ $data->no_kamar }}</p>
                        </div>
                    </div>

                    {{-- DETAIL INAP --}}
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Deskripsi</th>
                                <th class="text-center">Harga / Malam</th>
                                <th class="text-center">Durasi</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $hargaPerMalam = $data->total_harga / $lamaInap;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $data->nama_tipe }}</strong><br>
                                    <small class="text-muted">
                                        Check-in : {{ $checkin->format('d M Y') }}<br>
                                        Check-out : {{ $checkout->format('d M Y') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    Rp {{ number_format($hargaPerMalam, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    {{ $lamaInap }} malam
                                </td>
                                <td class="text-end fw-bold">
                                    Rp {{ number_format($data->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- TOTAL --}}
                    <div class="text-end mt-3">
                        <h6 class="text-muted">Total Pembayaran</h6>
                        <h3 class="text-success fw-bold">
                            Rp {{ number_format($data->total_harga, 0, ',', '.') }}
                        </h3>
                    </div>

                    <hr>

                    {{-- KONDISI PEMBAYARAN --}}
                    @if ($data->status_pembayaran !== 'Lunas')
                        {{-- FORM BAYAR --}}
                        <form action="{{ route('checkin.prosesBayar', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="fw-bold">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" class="form-control" required>
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="Cash">Cash</option>
                                        <option value="QRIS">QRIS</option>
                                    </select>
                                </div>

                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <button class="btn btn-success px-4">
                                        Bayar Sekarang
                                    </button>
                                    <a href="{{ route('checkin.index') }}" class="btn btn-outline-secondary px-4">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    @else
                        {{-- INVOICE LUNAS --}}
                        <div class="alert alert-success text-center fw-bold fs-5">
                            LUNAS
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Metode Pembayaran</strong></p>
                                <p>{{ $data->metode_pembayaran }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p><strong>Tanggal Bayar</strong></p>
                                <p>{{ Carbon::parse($data->tanggal_bayar)->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('checkin.index') }}" class="btn btn-secondary px-4">
                                Kembali
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
