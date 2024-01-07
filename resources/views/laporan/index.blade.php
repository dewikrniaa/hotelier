@extends('layouts.app-master')
@section('content')
@auth

<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <h4 class="card-header">Laporan Pendapatan</h4>
                        <table class="table table-bordered">
                            <caption class="ms-4 fw-bold text-end fs-3">
                                Total Pendapatan : {{$total_pendapatan}}
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
                                <td>{{ $data->tanggal}}</td>
                                <td>{{ $data->bulan}}</td>
                                <td>{{ $data->tahun}}</td>
                                <td>{{ $data->jumlah_check_in}}</td>
                                <td>{{ $data->total_transaksi}}</td>
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
    <script>
        //message with toastr
        @if(session() -> has('success'))
        toastr.success('{{ session('
            success ') }}', 'BERHASIL!');
        @elseif(session() -> has('error'))
        toastr.error('{{ session('
            error ') }}', 'GAGAL!');
        @endif
    </script>
    @endauth
    @endsection