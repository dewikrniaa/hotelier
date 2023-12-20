@extends('layouts.app-master')
@section('content')
@auth

<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan Nama">
                                <!-- error message untuk nofaktur_2257301071 -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Handphone</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="Masukkan Nomor Handphone">
                                <!-- error message untuk nofaktur_2257301071 -->
                                @error('no_hp')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email">
                                <!-- error message untuk nofaktur_2257301071 -->
                                @error('email')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat">
                                <!-- error message untuk nofaktur_2257301071 -->
                                @error('alamat')
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
                                <label class="font-weight-bold">Tanggal Check In</label>
                                <input type="datetime-local" class="form-control @error('checkin_date') is-invalid @enderror" name="checkin_date">
                                <!-- error message -->
                                @error('checkin_date') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Check Out</label>
                                <input type="datetime-local" class="form-control @error('checkout_date') is-invalid @enderror" name="checkout_date">
                                <!-- error message -->
                                @error('checkout_date') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah orang</label>
                                <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" name="jumlah_orang" placeholder="Masukkan Jumlah orang">
                                <!-- error message untuk kodepelanggan_2257301071 -->
                                @error('jumlah_orang')
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

