<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Surat Permohonan PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Formulir Surat Permohonan PKL</h2>
        <form id="suratForm">
            <div class="mb-3">
                <label class="form-label">Nomor Surat:</label>
                <input type="text" class="form-control" id="nomorSurat" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat PKL (Nama & Alamat):</label>
                <textarea class="form-control" id="tempatPkl" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Konsentrasi Keahlian:</label>
                <input type="text" class="form-control" id="konsentrasiKeahlian" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama dan NISN Siswa:</label>
                <textarea class="form-control" id="siswaList" rows="3" placeholder="Masukkan Nama dan NISN siswa, format: Nama - NISN" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Mulai PKL:</label>
                <input type="text" class="form-control" id="tanggalMulai" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Berakhir PKL:</label>
                <input type="text" class="form-control" id="tanggalBerakhir" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="generateSurat()">Generate Surat</button>
        </form>
        <div class="mt-5" id="suratOutput" style="border: 1px solid #ccc; padding: 20px; display: none;">
            <div class="row">
                <div class="col-2">
                <img src="img/jatim.png" alt="Logo" style="width: 100px;  height: auto;">
            </div>
            <div class="col-10 text-center">
            <h5 class="text-center">PEMERINTAH PROVINSI JAWA TIMUR</h5>
            <h6 class="text-center">DINAS PENDIDIKAN</h6>
            <h6 class="text-center">SMK NEGERI 2 BANGKALAN</h6>
            <h6 class="text-center">NPSN / NSS : 20531223 / 321052901002</h6>
            <p class="text-center">Jalan. Halim Perdana Kusuma (Ring Road), Mlajah, Kecamatan Bangkalan, Bangkalan, Jawa Timur 69116</p>
            <p class="text-center">Telepon (031) 3092223, Pos-el : smkn2_bkl@yahoo.com</p>
            </div>
            </div>
            <hr>
            <p class="text-end">Bangkalan, <span id="tanggal"></span></p>
            <p>Nomor: <span id="nomorSuratOutput"></span></p>
            <p>Hal: Permohonan Praktik Kerja Lapangan</p>
            <p>Lampiran: - </p>
            <p>Kepada Yth: <strong> Pimpinan/Direktur</strong> <strong><span id="pklNamaPt"></span></strong></p>
            <p>Assalamu'alaikum Wr. Wb.</p>
            <p>Dengan Hormat,</p>
            <p>Dalam penyelenggaraan Pendidikan tingkat kejuruan, disamping siswa melaksanakan Kegiatan Belajar Mengajar (KBM) di sekolah, siswa juga dituntut melaksanakan KBM di Dunia Usaha / Dunia Industri, yang dikenal istilah PKL (Praktik Kerja Lapangan).</p>
            <p>Berdasarkan kurikulum merdeka dilaksanakan selama 6 bulan, untuk itu kami mohon dengan sangat agar Bapak / Ibu Pimpinan <strong><span id="pklNama2"></span></strong>.</p>
            <p>berkenan menerima siswa kami untuk melaksanakan PKL :</p>
            <p><strong>Konsentrasi Keahlian:</strong> <span id="pklKonsentrasi"></span></p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                    </tr>
                </thead>
                <tbody id="siswaTable"></tbody>
            </table>
            <p>Pelaksanaan Praktik Kerja Lapangan ini akan dimulai tanggal <span id="pklTanggalMulai"></span> s/d <span id="pklTanggalBerakhir"></span>.</p>
            <p>Kami berharap jawaban/informasi tentang waktu dan lama pelaksanaan PKL pada DU / DI Bapak/Ibu segera kami dapatkan.</p>
            <p>Atas perhatian dan berkenannya permohonan ini, kami sampaikan terima kasih.</p>
            <p>Wassalamu'alaikum Wr. Wb.</p>
            <div class="text-end">
                <p>Hormat Kami,</p>
                <p>Kepala SMK Negeri 2 Bangkalan</p>
                <br><br><br>
                <p><strong>Nur Hazizah, S.Pd., M.Pd.</strong></p>
            </div>
        </div>
    </div>

    <script>
        function generateSurat() {
            const nomorSurat = document.getElementById("nomorSurat").value;
            const tempatPkl = document.getElementById("tempatPkl").value;
            const konsentrasiKeahlian = document.getElementById("konsentrasiKeahlian").value;
            const siswaList = document.getElementById("siswaList").value.split("\n");
            const tanggalMulai = document.getElementById("tanggalMulai").value;
            const tanggalBerakhir = document.getElementById("tanggalBerakhir").value;
            
            document.getElementById("nomorSuratOutput").innerText = nomorSurat;
            document.getElementById("pklNamaPt").innerText = tempatPkl;
            document.getElementById("pklNama2").innerText = tempatPkl.split("\n")[0];
            document.getElementById("pklKonsentrasi").innerText = konsentrasiKeahlian;
            document.getElementById("tanggal").innerText = new Date().toLocaleDateString("id-ID", { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById("pklTanggalMulai").innerText = tanggalMulai;
            document.getElementById("pklTanggalBerakhir").innerText = tanggalBerakhir;
            
            let siswaTable = "";
            siswaList.forEach((siswa, index) => {
                let data = siswa.split(" - ");
                if (data.length === 2) {
                    siswaTable += `<tr><td>${index + 1}</td><td>${data[0]}</td><td>${data[1]}</td></tr>`;
                }
            });
            document.getElementById("siswaTable").innerHTML = siswaTable;
            
            document.getElementById("suratOutput").style.display = "block";
        }
    </script>
</body>
</html>
