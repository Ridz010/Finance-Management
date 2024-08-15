<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpendSmart Pemasukan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        @include('sidebar')
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Pemasukan</h4>
                    </div>
                    <!-- Form untuk input data pemasukan -->
                    <form action="{{ route('pemasukan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_pemasukan" class="form-label">Jenis Pemasukan</label>
                            <select class="form-control" id="jenis_pemasukan" name="jenis_pemasukan" required>
                                @foreach($jenisPemasukanOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="sumber" class="form-label">Sumber</label>
                            <select class="form-control" id="sumber" name="sumber" required>
                                @foreach($sumberPemasukanOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                    <!-- Tabel untuk menampilkan data pemasukan -->
                    <div class="card border-0 mt-3">
                        <div class="card-header">
                            <h5 class="card-title">Data Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jenis Pemasukan</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Sumber</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemasukan as $index => $data)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->jenis_pemasukan }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>{{ $data->sumber }}</td>
                                        <td>{{ 'Rp '. number_format($data->jumlah, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('pemasukan.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('pemasukan.destroy', $data->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>SpendSmart</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        function hapusData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Kirim permintaan hapus dengan AJAX
                fetch('/pemasukan/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Refresh halaman jika penghapusan berhasil
                            location.reload();
                        } else {
                            // Tampilkan pesan error jika terjadi masalah
                            console.error('Terjadi kesalahan:', response.statusText);
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            }
        }
    </script>
</body>

</html>