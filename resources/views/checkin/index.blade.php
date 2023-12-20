@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('checkin.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA checkin</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tipe Kamar</th>
                                    <th scope="col">Check In Date</th>
                                    <th scope="col">Check Out Date</th>
                                    <th scope="col">Jumlah Orang</th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $checkin)
                                <tr>
                                    <td>{{ $checkin->nama}}</td>
                                    <td>{{ $checkin->no_hp}}</td>
                                    <td>{{ $checkin->email}}</td>
                                    <td>{{ $checkin->alamat}}</td>
                                    <td>{{ $checkin->tipe_kamar}}</td>
                                    <td>{{ $checkin->checkin_date}}</td>
                                    <td>{{ $checkin->checkout_date}}</td>
                                    <td>{{ $checkin->jumlah_orang}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('checkin.destroy', $checkin->id) }}" method="post">
                                            <a href="{{route('checkin.edit', $checkin->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data checkin belum tersedia.
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