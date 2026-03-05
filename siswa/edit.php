<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
// Ambil data siswa berdasarkan ID (NIS) dari URL
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$id'"));
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit Siswa</title> 
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
</head> 
<body> 
<div class="container mt-4"> 
    <h3>Edit Data Siswa</h3> 
 
    <form method="post"> 
        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" class="form-control" value="<?= $data['nis'] ?>" readonly> 
        </div>

        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama_siswa'] ?>" required> 
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?= $data['tempat_lahir'] ?>" required> 
            </div>
            <div class="col-md-6 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required> 
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>No Telepon</label>
            <input type="text" name="no_telepon" class="form-control" value="<?= $data['no_telepon'] ?>" required> 
        </div>

        <div class="mb-3">
            <label>Kompetensi Keahlian</label>
            <select name="kd_kompetensi" class="form-control" required> 
                <option value="">-- Pilih Kompetensi --</option> 
                <?php 
                $q_kom = mysqli_query($conn, "SELECT * FROM kompetensi"); 
                while($k = mysqli_fetch_assoc($q_kom)){ 
                    // Logika selected: Jika kode di DB sama dengan kode di loop, tambahkan 'selected'
                    $select = ($data['kd_kompetensi'] == $k['kd_kompetensi']) ? 'selected' : '';
                    echo "<option value='$k[kd_kompetensi]' $select>$k[nama_kompetensi]</option>"; 
                } 
                ?> 
            </select> 
        </div>
 
        <button name="update" class="btn btn-success">Update</button> 
        <a href="index.php" class="btn btn-secondary">Kembali</a> 
    </form> 
 
<?php 
if(isset($_POST['update'])){ 
    mysqli_query($conn,"UPDATE siswa SET 
        nama_siswa = '$_POST[nama_siswa]',
        tempat_lahir = '$_POST[tempat_lahir]',
        tgl_lahir = '$_POST[tgl_lahir]',
        alamat = '$_POST[alamat]',
        no_telepon = '$_POST[no_telepon]',
        kd_kompetensi = '$_POST[kd_kompetensi]'
        WHERE nis = '$id'
    "); 
    echo "<script>alert('Data siswa berhasil diupdate');location='index.php';</script>"; 
} 
?> 
</div> 
</body> 
</html>