<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Formulir Surat Permohonan PKL</h2>
        <form action="proses.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nomor Surat:</label>
                <input type="text" class="form-control" name="nomorSurat" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat PKL:</label>
                <input type="text" class="form-control" name="tempatPkl" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat PKL:</label>
                <textarea class="form-control" name="alamatPkl" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Konsentrasi Keahlian:</label>
                <input type="text" class="form-control" name="konsentrasiKeahlian" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama dan NISN Siswa:</label>
                <textarea class="form-control" name="siswaList" rows="3" placeholder="Nama - NISN" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Mulai PKL:</label>
                <input type="text" class="form-control" name="tanggalMulai" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Berakhir PKL:</label>
                <input type="text" class="form-control" name="tanggalBerakhir" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat Surat</button>
        </form>
    </div>
</body>
</html>
