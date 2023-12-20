@extends('layouts.app-master')

@section('content')
@auth
<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('checkout.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA CHECKOUT</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Handphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tipe kamar</th>
                                    <th scope="col">Check In Date</th>
                                    <th scope="col">Check In date</th>
                                    <th scope="col">Jumlah Orang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $checkout)
                                <tr>
                                    <td>{{ $checkout->nama}}</td>
                                    <td>{{ $checkout->no_hp}}</td>
                                    <td>{{ $checkout->email}}</td>
                                    <td>{{ $checkout->alamat}}</td>
                                    <td>{{ $checkout->tipe_kamar}}</td>
                                    <td>{{ $checkout->checkin_date}}</td>
                                    <td>{{ $checkout->checkout_date}}</td>
                                    <td>{{ $checkout->jumlah_orang}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('checkout.destroy', $checkout->id) }}" method="post">
                                            <a href="{{route('checkout.edit', $checkout->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Checkout kamar belum
                                    Tersedia.
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
        @if(session()-> has('success'))
        toastr.success('{{ session('success ') }}', 'BERHASIL!');
        @elseif(session()-> has('error'))
        toastr.error('{{ session('error ') }}', 'GAGAL!');
        @endif
    </script>
    @endauth
@endsection
