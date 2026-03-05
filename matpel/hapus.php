<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
mysqli_query($conn, "DELETE FROM matpel WHERE kd_matpel='$_GET[id]'"); 
header("location:index.php"); 
?> 