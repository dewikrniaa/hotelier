@extends('layouts.app-master')

@section('content')
    @auth
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 shadow rounded">
                                <div class="card-body">
                                    <h4 class="">Data Check In</h4>
                                    <a href="{{ route('checkin.create') }}" class="btn btn-success mb-3">
                                        TAMBAH CHECK-IN
                                    </a>

                                    <table id="checkin" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelanggan</th>
                                                <th>No Kamar</th>
                                                <th>Tipe Kamar</th>
                                                <th>Total Harga</th>
                                                <th>Status Inap</th>
                                                <th>Status Bayar</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $checkin)
                                                <tr>
                                                    <td>{{ $checkin->nama }}</td>
                                                    <td>{{ $checkin->no_kamar }}</td>
                                                    <td>{{ $checkin->nama_tipe }}</td>
                                                    <td>Rp {{ number_format($checkin->total_harga, 0, ',', '.') }}</td>

                                                    {{-- STATUS CHECK-IN --}}
                                                    <td>
                                                        <span
                                                            class="badge {{ $checkin->status_checkin === 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $checkin->status_checkin }}
                                                        </span>
                                                    </td>

                                                    {{-- STATUS PEMBAYARAN --}}
                                                    <td>
                                                        <span
                                                            class="badge {{ $checkin->status_pembayaran === 'Lunas' ? 'bg-primary' : 'bg-danger' }}">
                                                            {{ $checkin->status_pembayaran }}
                                                        </span>
                                                    </td>

                                                    <td>{{ $checkin->checkin_date }}</td>
                                                    <td>{{ $checkin->checkout_date }}</td>

                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-1 flex-nowrap">
                                                            {{-- EDIT --}}
                                                            @if ($checkin->status_checkin !== 'Checkout' && $checkin->status_pembayaran === 'Belum Bayar')
                                                                <a href="{{ route('checkin.edit', $checkin->id) }}"
                                                                    class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
                                                                    title="Edit">
                                                                    <i class="fa fa-pen icon-22px"></i>
                                                                </a>
                                                            @endif

                                                            {{-- BAYAR --}}
                                                            @if ($checkin->status_pembayaran === 'Belum Bayar')
                                                                <a href="{{ route('checkin.bayar', $checkin->id) }}"
                                                                    class="btn btn-icon btn-info" data-bs-toggle="tooltip"
                                                                    title="Bayar">
                                                                    <span class="fa fa-credit-card icon-22px"></span>
                                                                </a>
                                                            @endif


                                                            {{-- INVOICE --}}
                                                            @if ($checkin->status_pembayaran === 'Lunas')
                                                                <a href="{{ route('checkin.invoice', $checkin->id) }}"
                                                                    class="btn btn-icon btn-success" data-bs-toggle="tooltip"
                                                                    title="Invoice">
                                                                    <i class="fa fa-file-invoice icon-22px"></i>
                                                                </a>
                                                            @endif

                                                            {{-- CHECKOUT --}}
                                                            @if ($checkin->status_checkin === 'Aktif' && $checkin->status_pembayaran === 'Lunas')
                                                                <form action="{{ route('checkin.checkout', $checkin->id) }}"
                                                                    method="POST" class="d-inline-flex m-0 p-0">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="button" class="btn btn-icon btn-warning"
                                                                        data-bs-toggle="modal" title="Checkout"
                                                                        data-bs-target="#checkoutModal{{ $checkin->id }}">
                                                                        <i class="fa fa-door-open icon-22px"></i>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            {{-- HAPUS --}}

                                                            <button class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                                title="Hapus"
                                                                data-bs-target="#deleteModal{{ $checkin->id }}">
                                                                <i class="fa fa-trash icon-22px"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                {{-- MODAL --}}
                                                <div class="modal fade" id="deleteModal{{ $checkin->id }}" tabindex="-1"
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
                                                                <i class="fa fa-triangle-exclamation text-danger fs-1 mb-3"></i> <p></p></p>
                                                                <p>Apakah anda yakin ingin menghapus data checkin:
                                                                    <strong>{{ $checkin->nama }}</strong>
                                                            </div>

                                                            {{-- FOOTER --}}
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Batal
                                                                </button>

                                                                <form action="{{ route('checkin.destroy', $checkin->id) }}"
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
                                                {{-- ================= MODAL CHECKOUT ================= --}}
                                                <div class="modal fade" id="checkoutModal{{ $checkin->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            {{-- HEADER --}}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-warning">Konfirmasi Checkout
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            {{-- BODY --}}
                                                            <div class="modal-body text-center">
                                                                <i class="fa fa-door-open text-warning fs-1 mb-3"></i>

                                                                <p class="mb-1">Apakah Anda yakin ingin melakukan checkout
                                                                    untuk:</p>
                                                                <strong>{{ $checkin->nama }}</strong>

                                                                <p class="text-muted mt-2">
                                                                    Kamar {{ $checkin->no_kamar }} akan berubah status.
                                                                </p>
                                                            </div>

                                                            {{-- FOOTER --}}
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Batal
                                                                </button>

                                                                <form action="{{ route('checkin.checkout', $checkin->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-warning">
                                                                        Ya, Checkout
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- =============== END MODAL CHECKOUT =============== --}}

                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center text-danger">
                                                        Data check-in belum tersedia
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

            {{-- SCRIPT --}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#checkin').DataTable();
                });
            </script>
            <script>
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    .forEach(el => new bootstrap.Tooltip(el));
            </script>

            </body>
        @endauth
    @endsection
