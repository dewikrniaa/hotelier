@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('pelanggan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PELANGGAN</a>
                        <table id="pelanggan" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Foto KTP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggan->nama}}</td>
                                    <td>{{ $pelanggan->nik}}</td>
                                    <td><img src="{{asset('storage/ktp/'.$pelanggan->foto_ktp)}}" alt="foto ktp" width="100px"></td>
                                    <td>{{ $pelanggan->email}}</td>
                                    <td>{{ $pelanggan->alamat}}</td>
                                    <td>{{ $pelanggan->no_hp}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('pelanggan.destroy', $pelanggan->id_pelanggan) }}" method="post">
                                            <a href="{{route('pelanggan.edit', $pelanggan->id_pelanggan) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data pelanggan belum
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //message with toastr
        @if(session() -> has('success'))
        toastr.success('{{ session('
            success ') }}', 'BERHASIL!');
        @elseif(session() -> has('error'))
        toastr.error('{{ session('
            error ') }}', 'GAGAL!');
        @endif
        $(document).ready(function() {
            $('#pelanggan').DataTable();
        });
    </script>
 @endauth
@endsection