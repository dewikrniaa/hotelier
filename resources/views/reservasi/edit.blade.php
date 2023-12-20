<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Reservasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('reservasi.update',$data->id_reservasi) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="varchar" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan nama">
                                <!-- error message -->
                                @error('tanggal_masuk')
                                <div class="alert alert-danger mt-2">

                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk">
                                <!-- error message -->
                                @error('tanggal_masuk') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input type="datetime-local" class="form-control @error('tanggal_keluar') is-invalid @enderror" name="tanggal_keluar">
                                <!-- error message -->
                                @error('tanggal_masuk') 
                                <div class=" alert alert-danger mt-2">

                                {{ $message }}
                            </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

</body>

</html>