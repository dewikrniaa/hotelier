@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body">
                                <h4 class="">Data Pelanggan</h4>
                                <a href="{{ route('pelanggan.create') }}" class="btn btn-md btn-success mb-3">
                                    TAMBAH PELANGGAN
                                </a>

                                <table id="pelanggan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Foto KTP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $pelanggan)
                                            <tr>
                                                <td>{{ $pelanggan->nama }}</td>
                                                <td>{{ $pelanggan->nik }}</td>
                                                <td>
                                                    <img src="{{ route('ktp.view', $pelanggan->foto_ktp) }}" alt="Foto KTP"
                                                        width="100">
                                                </td>
                                                <td>{{ $pelanggan->email }}</td>
                                                <td>{{ $pelanggan->alamat }}</td>
                                                <td>{{ $pelanggan->no_hp }}</td>
                                                <td class="text-center">
                                                    {{-- EDIT --}}
                                                    <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}"
                                                        class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa fa-pen icon-22px"></i>
                                                    </a>

                                                    {{-- DELETE (MODAL TRIGGER) --}}
                                                    <button type="button" class="btn btn-icon btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $pelanggan->id_pelanggan }}">
                                                        <i class="fa fa-trash icon-22px"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            {{-- MODAL --}}
                                            <div class="modal fade" id="deleteModal{{ $pelanggan->id_pelanggan }}"
                                                tabindex="-1" aria-hidden="true">

                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        {{-- HEADER --}}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        {{-- BODY --}}
                                                        <div class="modal-body text-center">
                                                            <i class="fa fa-triangle-exclamation text-danger fs-1 mb-3"></i>
                                                            <p>Apakah anda yakin ingin menghapus data pelanggan: <strong>{{ $pelanggan->nama }}</strong>
                                                        </div>

                                                        {{-- FOOTER --}}
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>

                                                            <form
                                                                action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    Ya, Hapus
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-danger">
                                                    Data pelanggan belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
