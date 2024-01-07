@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pelanggan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama">
                                <!-- error message untuk nama -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                <!-- error message untuk email -->
                                @error('email')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat">
                                <!-- error message untuk alamat -->
                                @error('alamat')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">No HP</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="No HP">
                                <!-- error message untuk no_hp -->
                                @error('no_hp')
                                <div class="alert alert-danger mt-2">

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