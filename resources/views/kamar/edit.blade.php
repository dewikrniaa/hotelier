@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('kamar.update',$data->id_kamar) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Kamar</label>
                                <input type="text" class="form-control @error('no_kamar') is-invalid @enderror" name="no_kamar" placeholder="Masukkan Nomor kamar">
                                <!-- error message untuk nofaktur_2257301071 -->
                                @error('no_kamar')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Terpesan">Terpesan</option>
                                    <option value="Sedang Ditempati">Sedang Ditempati</option>
                                    <option value="Maintenance">Maintenance</option>
                                </select>
                                <!-- error message untuk status -->
                                @error('status')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah orang</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" placeholder="Masukkan Jumlah orang">
                                <!-- error message untuk kodepelanggan_2257301071 -->
                                @error('jumlah')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tipe Kamar</label>
                                <select class="form-control @error('tipe_kamar') is-invalid @enderror" name="tipe_kamar">
                                    <option value="Standar">Standar</option>
                                    <option value="Superior">Superior</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                </select>
                                <!-- error message untuk tipe_kamar -->
                                @error('tipe_kamar')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <select class="form-control @error('harga') is-invalid @enderror" name="harga">
                                    <option value="500000">500,000</option>
                                    <option value="600000">600,000</option>
                                    <option value="700000">700,000</option>
                                    <option value="800000">800,000</option>
                                </select>
                                <!-- error message untuk harga -->
                                @error('harga')
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