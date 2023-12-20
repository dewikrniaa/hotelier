@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('laporan.update',

$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group"><label class="font-weight-bold">Tanggal Masuk</label>

                                <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" placeholder="Masukkan Tanggal
Masuk" value="{{ $data->tanggal_masuk }}">


                                <!-- error message untuk title -->
                                @error('tanggal_masuk')
                                <div class="alert alert-danger

mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>

                                <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror" name="tanggal_keluar" placeholder="Masukkan Tanggal

laporan" value="{{ $data->tanggal_keluar }}">

                                <!-- error message untuk cost -->
                                @error('tanggal_keluar')
                                <div class="alert alert-danger

mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Transaksi</label>

                                <input type="file" class="form-control @error('transaksi') is-invalid @enderror" name="transaksi">
                                <!-- error message untuk due_date

-->

                                @error('transaksi')
                                <div class="alert alert-danger

mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Total</label>
                                <input type="number" class="form-control @error('total') is-invalid @enderror" name="total" placeholder="Masukkan Total" value="{{ $data->total }}">

                                <!-- error message untuk description

-->

                                @error('total')
                                <div class="alert alert-danger

mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md

btn-primary">SIMPAN</button>

                            <button type="reset" class="btn btn-md

btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection