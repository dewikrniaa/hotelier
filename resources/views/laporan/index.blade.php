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
                                <h4 class="">Laporan Pendapatan</h4>
                                <form action="{{ route('laporan.export') }}" method="GET" class="row mb-3 align-items-end">

                                    {{-- FILTER --}}
                                    <div class="col-md-2">
                                        <label class="fw-bold">Periode</label>
                                        <select name="periode" class="form-control" required>
                                            <option value="">-- Pilih Periode --</option>
                                            <option value="harian">Harian</option>
                                            <option value="bulanan">Bulanan</option>
                                            <option value="tahunan">Tahunan</option>
                                        </select>
                                    </div>

                                    {{-- SPACER --}}
                                    <div class="col-md-6"></div>

                                    {{-- ACTION BUTTON --}}
                                    <div class="col-md-2">
                                        <button type="submit" name="format" value="pdf" class="btn btn-danger w-100">
                                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                                        </button>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" name="format" value="excel" class="btn btn-success w-100">
                                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                                        </button>
                                    </div>

                                </form>

                                <table id="laporan" class="table table-bordered table-striped">
                                    <caption class="ms-4 fw-bold text-end fs-3">
                                        Total Pendapatan : {{ 'RP ' . number_format($total_pendapatan, 0, ',', '.') }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Jumlah Check In</th>
                                            <th scope="col">Total Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($laporan as $data)
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ date('F', mktime(0, 0, 0, $data->bulan, 1)) }}</td>
                                            <td>{{ $data->tahun }}</td>
                                            <td>{{ $data->jumlah_check_in }}</td>
                                            <td>{{ 'RP ' . number_format($data->total_transaksi, 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data laporan belum tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
            <script>
                //message with toastr
                @if (session()->has('success'))
                    toastr.success(
                        '{{ session('
                                                                                                                        success ') }}',
                        'BERHASIL!');
                @elseif (session()->has('error'))
                    toastr.error(
                        '{{ session('
                                                                                                                    error ') }}',
                        'GAGAL!');
                @endif
                $(document).ready(function() {
                    $('#laporan').DataTable();
                });
            </script>
        @endauth
    @endsection
