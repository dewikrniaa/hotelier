@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <h4 class="">Data Kamar</h4>
                        <a href="{{ route('kamar.create') }}" class="btn btn-success mb-3">
                            Tambah Data Kamar
                        </a>

                        <table id="kamar" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No Kamar</th>
                                    <th>Status</th>
                                    <th>Tipe Kamar</th>
                                    <th>Kapasitas</th>
                                    <th>Harga / Malam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $kamar)
                                    <tr>
                                        <td>{{ $kamar->no_kamar }}</td>
                                        <td>{{ $kamar->status }}</td>
                                        <td>{{ $kamar->nama_tipe }}</td>
                                        <td>{{ $kamar->kapasitas }} Orang</td>
                                        <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('kamar.edit', $kamar->id_kamar) }}"
                                                class="btn btn-icon btn-primary"> <i class="fa fa-pen icon-22px"></i>
                                            </a>
                                            {{-- SELESAI MAINTENANCE --}}
                                            @if ($kamar->status === 'Maintenance')
                                                <form action="{{ route('kamar.selesaiMaintenance', $kamar->id_kamar) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-icon btn-success"
                                                        data-bs-toggle="modal" title="Maintenance Selesai"
                                                        data-bs-target="#maintenanceModal{{ $kamar->id_kamar }}">
                                                        <i class="fa fa-check icon-22px"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            {{-- DELETE (MODAL TRIGGER) --}}
                                            <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $kamar->id_kamar }}">
                                                <i class="fa fa-trash icon-22px"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- MODAL --}}
                                    <div class="modal fade" id="deleteModal{{ $kamar->id_kamar }}" tabindex="-1"
                                        aria-hidden="true">

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
                                                    <p>Apakah anda yakin ingin menghapus data kamar:
                                                        <strong>{{ $kamar->no_kamar }}</strong>
                                                </div>

                                                {{-- FOOTER --}}
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form action="{{ route('kamar.destroy', $kamar->id_kamar) }}"
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
                                    {{-- ================= MODAL MAINTENANCE ================= --}}
                                    <div class="modal fade" id="maintenanceModal{{ $kamar->id_kamar }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                {{-- HEADER --}}
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-success">Selesaikan Maintenance</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                {{-- BODY --}}
                                                <div class="modal-body text-center">
                                                    <i class="fa fa-screwdriver-wrench text-success fs-1 mb-3"></i>

                                                    <p class="mb-1">
                                                        Apakah Anda yakin maintenance kamar berikut sudah selesai?
                                                    </p>

                                                    <strong>Kamar {{ $kamar->no_kamar }}</strong>

                                                    <p class="text-muted mt-2">
                                                        Status kamar akan berubah menjadi <b>Tersedia</b>.
                                                    </p>
                                                </div>

                                                {{-- FOOTER --}}
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form
                                                        action="{{ route('kamar.selesaiMaintenance', $kamar->id_kamar) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">
                                                            Ya, Selesaikan
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- =============== END MODAL MAINTENANCE =============== --}}

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            Data kamar belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        {{-- Flash Message --}}
        <div id="flash-message" data-success="{{ session('success') }}" data-error="{{ session('error') }}">
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#kamar').DataTable();

                const flash = document.getElementById('flash-message');

                if (flash.dataset.success) {
                    toastr.success(flash.dataset.success);
                }

                if (flash.dataset.error) {
                    toastr.error(flash.dataset.error);
                }
            });
        </script>
    @endsection
