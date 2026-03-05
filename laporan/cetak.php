<?php 
include "../config/koneksi.php";
include "../auth/cek_session.php"; // Tetap dicek loginnya biar aman

// Ambil data filter dari URL
$nis = $_GET['nis'];
$semester = $_GET['semester'];
$tapel = $_GET['tapel'];

// 1. Ambil Data Identitas Siswa
$q_siswa = mysqli_query($conn, "
    SELECT s.*, k.nama_kompetensi 
    FROM siswa s
    JOIN kompetensi k ON s.kd_kompetensi = k.kd_kompetensi
    WHERE s.nis = '$nis'
");
$d_siswa = mysqli_fetch_assoc($q_siswa);

if(!$d_siswa){
    die("<div class='alert alert-danger'>Data siswa tidak ditemukan.</div>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Rapor - <?= $d_siswa['nama_siswa'] ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <style>
        /* CSS Khusus Cetak agar tampilan rapi seperti surat */
        body { 
            font-family: "Times New Roman", Times, serif; 
            background-color: white;
            color: black;
            padding: 20px;
        }
        .header-laporan { 
            text-align: center; 
            border-bottom: 3px double black; 
            margin-bottom: 20px; 
            padding-bottom: 10px; 
        }
        .tabel-info td { padding: 5px; }
        
        /* Hilangkan tombol saat di-print */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="header-laporan">
        <h3 class="m-0">SMK NEGERI CONTOH</h3>
        <p class="m-0">Jl. Pendidikan No. 123, Kota Coding</p>
        <h4 class="mt-3">LAPORAN HASIL BELAJAR SISWA</h4>
    </div>

    <table class="tabel-info mb-4" width="100%">
        <tr>
            <td width="15%">Nama Siswa</td>
            <td width="2%">:</td>
            <td width="40%"><b><?= $d_siswa['nama_siswa'] ?></b></td>
            <td width="15%">Tahun Pelajaran</td>
            <td width="2%">:</td>
            <td><?= $tapel ?></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><?= $d_siswa['nis'] ?></td>
            <td>Semester</td>
            <td>:</td>
            <td><?= $semester ?></td>
        </tr>
        <tr>
            <td>Kompetensi</td>
            <td>:</td>
            <td><?= $d_siswa['nama_kompetensi'] ?></td>
            <td></td><td></td><td></td>
        </tr>
    </table>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Mata Pelajaran</th>
                <th colspan="2">Nilai</th>
                <th rowspan="2" class="align-middle">Nilai Akhir</th>
                <th rowspan="2" class="align-middle">Guru Pengajar</th>
            </tr>
            <tr>
                <th>P (Pengetahuan)</th>
                <th>K (Keterampilan)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            // Query ambil nilai + nama matpel + nama guru
            $q_nilai = mysqli_query($conn, "
                SELECT n.*, m.nama_matpel, g.nama_guru
                FROM nilai n
                JOIN matpel m ON n.kd_matpel = m.kd_matpel
                LEFT JOIN guru g ON m.nip = g.nip
                WHERE n.nis = '$nis' 
                AND n.semester = '$semester' 
                AND n.tapel = '$tapel'
            ");

            if(mysqli_num_rows($q_nilai) > 0){
                while($n = mysqli_fetch_assoc($q_nilai)){ 
                    // Rumus Nilai Akhir (Rata-rata P dan K)
                    $akhir = ($n['nilai_p'] + $n['nilai_k']) / 2;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td class="text-start"><?= $n['nama_matpel'] ?></td>
                    <td><?= $n['nilai_p'] ?></td>
                    <td><?= $n['nilai_k'] ?></td>
                    <td><b><?= number_format($akhir, 2) ?></b></td>
                    <td class="text-start"><?= $n['nama_guru'] ?></td>
                </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='6' class='text-danger p-3'>Belum ada data nilai pada semester ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-4 text-center">
            <br>Orang Tua / Wali,<br><br><br><br>
            ( .............................. )
        </div>
        <div class="col-4"></div>
        <div class="col-4 text-center">
            Mengetahui,<br>
            Wali Kelas<br><br><br><br>
            ( .............................. )
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>
</html>