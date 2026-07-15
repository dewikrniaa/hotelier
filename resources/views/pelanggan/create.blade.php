@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <h4 class="">Tambah Data Pelanggan</h4>
                        <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    required>
                                @error('nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                    maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}" required>
                                <small class="text-muted">NIK harus 16 digit angka</small>
                                @error('nik')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Upload KTP</label>
                                <input type="file" name="foto_ktp"
                                    class="form-control @error('foto_ktp') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.pdf" required>
                                <small class="text-muted">Format file: JPG, PNG, PDF</small>
                                @error('foto_ktp')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"
                                    required>
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>No HP</label>
                                <input type="text" name="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp', $data->no_hp ?? '+62') }}" pattern="^\+62[0-9]{8,13}$"
                                    placeholder="+628xxxxxxxxx" required>
                                <small class="text-muted">
                                    Format nomor harus diawali +62, contoh: +628123456789
                                </small>
                                @error('no_hp')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
