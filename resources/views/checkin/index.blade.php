@extends('layouts.app-master')
@section('content')
@auth
<body style="background: white">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('checkin.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA </a>
                        <table id="checkin" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Kamar</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status</th>
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
                                    <td>{{ $checkin->no_kamar}}</td>
                                    <td>{{ "RP ".number_format($checkin->total_harga,0,',','.')}}</td>
                                    <td>{{ $checkin->status_checkin}}</td>
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
            $('#checkin').DataTable();
        });
    </script>
 @endauth
@endsection