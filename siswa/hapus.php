<?php 
include "../config/koneksi.php";
include "../auth/cek_session.php";
include "../layout/menu.php";

$id = $_GET['id'];

// Proses hapus
$hapus = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$id'");

if($hapus){
    echo "<script>alert('Data berhasil dihapus');location='index.php';</script>";
} else {
    // Error handling jika NIS masih dipakai di tabel nilai (constraint)
    echo "<script>alert('Gagal menghapus! Data siswa ini mungkin masih digunakan di tabel Nilai.');location='index.php';</script>";
}
?>