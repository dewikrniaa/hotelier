@extends('layouts.app-master')
@section('content')
@auth
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('reservasi.update',$data->id_reservasi) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="varchar" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan nama">
                                <!-- error message -->
                                @error('tanggal_masuk')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk">
                                <!-- error message -->
                                @error('tanggal_masuk') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input type="datetime-local" class="form-control @error('tanggal_keluar') is-invalid @enderror" name="tanggal_keluar">
                                <!-- error message -->
                                @error('tanggal_masuk') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
    @endsection