@extends('layouts.app-master')
@section('content')
@auth

<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h4 class="">Laporan Pendapatan</h4>
                        <table id="laporan" class="table table-bordered">
                            <caption class="ms-4 fw-bold text-end fs-3">
                                Total Pendapatan : {{ "RP ".number_format($total_pendapatan,0,',','.')}}
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
                                <td>{{ date("F",mktime(0,0,0,$data->bulan,1))}}</td>
                                <td>{{ $data->tahun}}</td>
                                <td>{{ $data->jumlah_check_in}}</td>
                                <td>{{ "RP ".number_format($data->total_transaksi,0,',','.')}}</td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //message with toastr
        @if(session() -> has('success'))
        toastr.success('{{ session('
            success ') }}', 'BERHASIL!');
        @elseif(session() -> has('error'))
        toastr.error('{{ session('
            error ') }}', 'GAGAL!');
        @endif
        $(document).ready(function() {
            $('#laporan').DataTable();
        });
    </script>
    @endauth
    @endsection