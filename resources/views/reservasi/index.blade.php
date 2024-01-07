@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('reservasi.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA RESERVASI</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">nama_pelanggan</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $reservasi)
                                <tr>
                                    <td>{{ $reservasi->nama_pelanggan}}</td>
                                    <td>{{ $reservasi->tanggal_masuk}}</td>
                                    <td>{{ $reservasi->tanggal_keluar}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('reservasi.destroy', $reservasi->id_reservasi) }}" method="post">
                                            <a href="{{route('reservasi.edit', $reservasi->id_reservasi) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data reservasi belum
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