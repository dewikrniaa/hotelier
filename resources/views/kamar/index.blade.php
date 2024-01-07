@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('kamar.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA KAMAR</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor kamar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Jumlah Orang</th>
                                    <th scope="col">Tipe kamar</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $kamar)
                                <tr>
                                    <td>{{ $kamar->no_kamar}}</td>
                                    <td>{{ $kamar->status}}</td>
                                    <td>{{ $kamar->jumlah}}</td>
                                    <td>{{ $kamar->tipe_kamar}}</td>
                                    <td>{{ $kamar->harga}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('kamar.destroy', $kamar->id_kamar) }}" method="post">
                                            <a href="{{route('kamar.edit', $kamar->id_kamar) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                Data kamar belum tersedia.
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