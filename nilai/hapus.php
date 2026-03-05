<?php 
include "../config/koneksi.php";
include "../auth/cek_session.php";
include "../layout/menu.php";

$id = $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM nilai WHERE kd_nilai='$id'");

if($hapus){
    echo "<script>alert('Data nilai dihapus');location='index.php';</script>";
}
?>