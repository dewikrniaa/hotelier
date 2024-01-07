@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('checkin.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">No Kamar</label>
                                <select class="form-control @error('id_kamar') is-invalid @enderror" name="id_kamar">
                                @foreach ($kamar as $datakamar)
                                    <option value="{{$datakamar->id_kamar}}">{{$datakamar->no_kamar}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk tipe_kamar -->
                                @error('id_kamar')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Nama</label>
                                <select class="form-control @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan">
                                @foreach ($pelanggan as $datapelanggan)
                                    <option value="{{$datapelanggan->id_pelanggan}}">{{$datapelanggan->nama}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk tipe_kamar -->
                                @error('id_pelanggan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                                <div class="form-group mb-4">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Checkout">Checkout</option>
                                    <option value="Reservasi">Reservasi</option>
                                </select>
                                <!-- error message untuk tipe_kamar -->
                                @error('status')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Check In Date</label>
                                <input type="date" class="form-control @error('checkin_date') is-invalid @enderror" name="checkin_date" placeholder="Check In Date">
                                <!-- error message untuk no_hp -->
                                @error('checkin_date')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Check Out Date</label>
                                <input type="date" class="form-control @error('checkout_date') is-invalid @enderror" name="checkout_date" placeholder="Check Out Date">
                                <!-- error message untuk checkout_date -->
                                @error('checkout_date')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Jumlah Orang</label>
                                <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" name="jumlah_orang" placeholder="Jumlah Orang">
                                <!-- error message untuk no_hp -->
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