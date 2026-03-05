<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
 
// ambil data matpel 
$data = mysqli_fetch_assoc(mysqli_query( 
    $conn, 
    "SELECT * FROM matpel WHERE kd_matpel='$_GET[id]'" 
)); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit Matpel</title> 
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
</head> 
<body> 
<div class="container mt-4"> 
    <h3>Edit Mata Pelajaran</h3> 
 
    <form method="post"> 
        <div class="mb-3"> 
            <label>Kode Matpel</label> 
            <input type="text" class="form-control" 
                   value="<?= $data['kd_matpel'] ?>" readonly> 
        </div> 
 
        <div class="mb-3"> 
            <label>Nama Matpel</label> 
            <input type="text" name="nama_matpel" 
                   value="<?= $data['nama_matpel'] ?>" class="form-control" required> 
        </div> 
 
        <div class="mb-3"> 
            <label>Jumlah Jam</label> 
            <input type="number" name="jumlah_jam" 
                   value="<?= $data['jumlah_jam'] ?>" class="form-control"> 
        </div> 
 
        <div class="mb-3"> 
            <label>Tingkat</label> 
            <input type="text" name="tingkat" 
                   value="<?= $data['tingkat'] ?>" class="form-control"> 
        </div> 
 
        <div class="mb-3"> 
            <label>Kompetensi</label> 
            <select name="kd_kompetensi" class="form-control" required> 
                <?php 
                $q = mysqli_query($conn, "SELECT * FROM kompetensi"); 
                while ($k = mysqli_fetch_assoc($q)) { 
                    $selected = ($k['kd_kompetensi'] == $data['kd_kompetensi']) ? "selected" : ""; 
                    echo "<option value='$k[kd_kompetensi]' $selected> 
                            $k[nama_kompetensi] 
                          </option>"; 
                } 
                ?> 
            </select> 
        </div> 
 
        <button name="update" class="btn btn-success">Update</button> 
        <a href="index.php" class="btn btn-secondary">Kembali</a> 
    </form> 
 
<?php 
if (isset($_POST['update'])) { 
    mysqli_query($conn, "UPDATE matpel SET 
        nama_matpel='$_POST[nama_matpel]', 
        jumlah_jam='$_POST[jumlah_jam]', 
        tingkat='$_POST[tingkat]', 
        kd_kompetensi='$_POST[kd_kompetensi]' 
        WHERE kd_matpel='$_GET[id]' 
    "); 
echo "<script>alert('Data berhasil diupdate');location='index.php';</script>"; 
} 
?> 
</div> 
</body> 
</html> 