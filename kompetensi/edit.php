<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kompetensi WHERE kd_kompetensi='$_GET[id]'")); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit Kompetensi</title> 
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
</head> 
<body> 
<div class="container mt-4"> 
    <h3>Edit Kompetensi</h3> 
 
    <form method="post"> 
        <div class="mb-3"> 
            <label>Kode Kompetensi</label> 
            <input type="text" class="form-control" value="<?= $data['kd_kompetensi'] ?>" readonly> 
        </div> 
 
        <div class="mb-3"> 
            <label>Nama Kompetensi</label> 
            <input type="text" name="nama_kompetensi" 
                   value="<?= $data['nama_kompetensi'] ?>" class="form-control" required> 
        </div> 
 
        <div class="mb-3"> 
            <label>Program Keahlian</label> 
            <input type="text" name="prog_keahlian" 
                   value="<?= $data['prog_keahlian'] ?>" class="form-control" required> 
        </div> 
 
        <button name="update" class="btn btn-success">Update</button> 
        <a href="index.php" class="btn btn-secondary">Kembali</a> 
    </form> 
 
<?php 
if (isset($_POST['update'])) { 
    mysqli_query($conn, "UPDATE kompetensi SET 
        nama_kompetensi='$_POST[nama_kompetensi]', 
        prog_keahlian='$_POST[prog_keahlian]' 
        WHERE kd_kompetensi='$_GET[id]' 
    "); 
    echo "<script>alert('Data berhasil diupdate');location='index.php';</script>"; 
} 
?> 
</div> 
</body> 
</html> 