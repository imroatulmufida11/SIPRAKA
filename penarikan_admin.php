<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Surat Penarikan PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Formulir Surat Penarikan PKL</h2>
        <form id="suratForm">
            <div class="mb-3">
                <label class="form-label">Nomor Surat:</label>
                <input type="text" class="form-control" id="nomorSurat" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat PKL:</label>
                <input type="text" class="form-control" id="tempatPkl" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat PKL:</label>
                <textarea class="form-control" id="alamatPkl" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Berakhir PKL:</label>
                <input type="text" class="form-control" id="tanggalBerakhir" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konsentrasi Keahlian:</label>
                <input type="text" class="form-control" id="konsentrasiKeahlian" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama, NISN, dan Tingkat Siswa (Pisahkan dengan Koma, Satu Per Baris):</label>
                <textarea class="form-control" id="siswaList" rows="3" placeholder="Contoh: Achmad Daniel Reza, 0079462072, XII/1" required></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="generateSurat()">Generate Surat</button>
        </form>

        <div class="mt-5" id="suratOutput" style="border: 1px solid #ccc; padding: 20px; display: none;">
        <div class="row">
                <div class="col-2">
                <img src="img/jatim.png" alt="Logo" style="width: 100px; height: auto;">
            </div>
            <div class="col-10 text-center">
                <h5><strong>PEMERINTAH PROVINSI JAWA TIMUR</strong></h5>
                <h6><strong>DINAS PENDIDIKAN</strong></h6>
                <h6><strong>SMK NEGERI 2 BANGKALAN</strong></h6>
                <h6>NPSN / NSS : 20531223 / 321052901002</h6>
                <p>Jalan. Halim Perdana Kusuma (Ring Road), Mlajah, Kecamatan Bangkalan, Bangkalan, Jawa Timur 69116</p>
                <p>Telepon (031) 3092223, Pos-el : smkn2_bkl@yahoo.com</p>
            </div>
        </div>
        <hr>
            <p class="text-end">Bangkalan, <span id="tanggal"></span></p>
            <p>Nomor: <span id="nomorSuratOutput"></span></p>
            <p>Hal: Penarikan siswa Praktik Kerja Lapangan</p>
            <p>Lampiran: - </p>
            <p>Kepada Yth: <strong>Bapak/Ibu Pimpinan</strong></p>
            <p><strong><span id="pklNamaPt"></span></strong></p>
            <p><span id="alamatPklOutput"></span></p>
            <p>Assalamu'alaikum Wr. Wb.</p>
            <p>Dengan Hormat,</p>
            <p>Dengan ini Tim Praktek Kerja Lapangan (PKL) SMK Negeri 2 Bangkalan, menginformasikan siswa:</p>
            <p><strong>Konsentrasi Keahlian: </strong><span id="konsentrasiKeahlianOutput"></span></p>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Tingkat / Semester</th>
                    </tr>
                </thead>
                <tbody id="siswaTable"></tbody>
            </table>
            <p>Peserta Praktek Kerja Lapangan pada Perusahaan Bapak/Ibu akan kami tarik, karena masa pelaksanaan PKL berakhir tanggal <span id="tanggalBerakhirOutput"></span>. Selanjutnya kami menyampaikan terima kasih atas kerjasamanya dalam membimbing serta membina siswa kami selama ini.</p>
            <p>Besar harapan kami untuk dapat melanjutkan kerjasama ini di masa mendatang.</p>
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
            document.getElementById("suratOutput").style.display = "block";
            document.getElementById("nomorSuratOutput").innerText = document.getElementById("nomorSurat").value;
            document.getElementById("pklNamaPt").innerText = document.getElementById("tempatPkl").value;
            document.getElementById("alamatPklOutput").innerText = document.getElementById("alamatPkl").value;
            document.getElementById("tanggal").innerText = new Date().toLocaleDateString("id-ID", { day: 'numeric', month: 'long', year: 'numeric' });
            document.getElementById("tanggalBerakhirOutput").innerText = document.getElementById("tanggalBerakhir").value;
            document.getElementById("konsentrasiKeahlianOutput").innerText = document.getElementById("konsentrasiKeahlian").value;
            
            let siswaTable = document.getElementById("siswaTable");
            siswaTable.innerHTML = "";
            let siswaList = document.getElementById("siswaList").value.split("\n");
            siswaList.forEach((siswa, index) => {
                let [nama, nisn, tingkat] = siswa.split(",").map(s => s.trim());
                siswaTable.innerHTML += `<tr><td>${index + 1}</td><td>${nama}</td><td>${nisn}</td><td>${tingkat}</td></tr>`;
            });
        }
    </script>
</body>
</html>
