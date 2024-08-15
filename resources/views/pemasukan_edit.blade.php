<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemasukan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Edit Pemasukan</h2>
                <!-- Form untuk mengedit data pemasukan -->
                <form id="editForm" action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pemasukan->tanggal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $pemasukan->keterangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sumber" class="form-label">Sumber</label>
                        <input type="text" class="form-control" id="sumber" name="sumber" value="{{ $pemasukan->sumber }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pemasukan->jumlah }}" required>
                    </div>
                    <!-- Tombol untuk menyimpan perubahan -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <!-- Tombol untuk kembali ke halaman pemasukan -->
                    <a href="{{ route('pemasukan') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Menangani submit form
        document.getElementById('editForm').addEventListener('submit', async function(event) {
            // Menghentikan aksi default form
            event.preventDefault();
    
            try {
                // Kirim permintaan AJAX untuk submit form
                const response = await fetch(this.action, {
                    method: this.method,
                    body: new FormData(this)
                });
    
                // Cek apakah permintaan berhasil
                if (response.ok) {
                    // Redirect ke halaman pemasukan setelah berhasil menyimpan perubahan
                    window.location.href = '{{ route('pemasukan') }}';
                    {{ session('success') }}
                } else {
                    console.error('Gagal menyimpan perubahan');
                }
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    </script>    
</body>

</html>
