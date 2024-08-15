<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengeluaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Edit Pengeluaran</h2>
                <!-- Form untuk mengedit data pengeluaran -->
                <form id="editForm" action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pengeluaran->tanggal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $pengeluaran->keterangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan" name="keperluan" value="{{ $pengeluaran->keperluan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pengeluaran->jumlah }}" required>
                    </div>
                    <!-- Tombol untuk menyimpan perubahan -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <!-- Tombol untuk kembali ke halaman pengeluaran -->
                    <a href="{{ route('pengeluaran') }}" class="btn btn-secondary">Kembali</a>
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
                    // Redirect ke halaman pengeluaran setelah berhasil menyimpan perubahan
                    window.location.href = '{{ route('pengeluaran') }}';
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
