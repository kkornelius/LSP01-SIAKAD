<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
$id = $_GET['id'];
// Ambil data nilai berdasarkan kd_nilai
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nilai WHERE kd_nilai='$id'"));
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit Nilai</title> 
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
</head> 
<body> 
<div class="container mt-4"> 
    <h3>Edit Nilai</h3> 
 
    <form method="post"> 
        <div class="mb-3">
            <label>Nama Siswa</label>
            <select name="nis" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                <?php 
                $q_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                while($s = mysqli_fetch_assoc($q_siswa)){
                    $sel = ($data['nis'] == $s['nis']) ? 'selected' : '';
                    echo "<option value='$s[nis]' $sel>$s[nis] - $s[nama_siswa]</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Mata Pelajaran</label>
            <select name="kd_matpel" class="form-control" required>
                <option value="">-- Pilih Matpel --</option>
                <?php 
                $q_matpel = mysqli_query($conn, "SELECT * FROM matpel ORDER BY nama_matpel ASC");
                while($m = mysqli_fetch_assoc($q_matpel)){
                    $sel = ($data['kd_matpel'] == $m['kd_matpel']) ? 'selected' : '';
                    echo "<option value='$m[kd_matpel]' $sel>$m[nama_matpel]</option>";
                }
                ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nilai Pengetahuan (P)</label>
                <input type="number" step="0.01" name="nilai_p" class="form-control" value="<?= $data['nilai_p'] ?>" required> 
            </div>
            <div class="col-md-6 mb-3">
                <label>Nilai Keterampilan (K)</label>
                <input type="number" step="0.01" name="nilai_k" class="form-control" value="<?= $data['nilai_k'] ?>" required> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Semester</label>
                <select name="semester" class="form-control" required>
                    <option value="Ganjil" <?= ($data['semester'] == 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
                    <option value="Genap" <?= ($data['semester'] == 'Genap') ? 'selected' : '' ?>>Genap</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Tahun Pelajaran (Tapel)</label>
                <input type="text" name="tapel" class="form-control" value="<?= $data['tapel'] ?>" required> 
            </div>
        </div>
 
        <button name="update" class="btn btn-success">Update</button> 
        <a href="index.php" class="btn btn-secondary">Kembali</a> 
    </form> 
 
<?php 
if(isset($_POST['update'])){ 
    mysqli_query($conn,"UPDATE nilai SET 
        nis = '$_POST[nis]',
        kd_matpel = '$_POST[kd_matpel]',
        nilai_p = '$_POST[nilai_p]',
        nilai_k = '$_POST[nilai_k]',
        semester = '$_POST[semester]',
        tapel = '$_POST[tapel]'
        WHERE kd_nilai = '$id'
    "); 
    echo "<script>alert('Data nilai berhasil diupdate');location='index.php';</script>"; 
} 
?> 
</div> 
</body> 
</html>