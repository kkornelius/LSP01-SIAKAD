<?php 
session_start(); 
include "../config/koneksi.php"; 
 
$username = mysqli_real_escape_string($conn,$_POST['username']); 
$password = md5($_POST['password']); 
 
$q = mysqli_query($conn,"SELECT * FROM users  
    WHERE username='$username'  
    AND password='$password' 
    AND status='aktif' 
"); 
 
$data = mysqli_fetch_assoc($q); 
$cek  = mysqli_num_rows($q); 
 
if($cek > 0){ 
    $_SESSION['id_user'] = $data['id_user']; 
    $_SESSION['username'] = $data['username']; 
    $_SESSION['level'] = $data['level']; 
    $_SESSION['nip'] = $data['nip']; 
 
    if($data['level']=='admin'){ 
        header("location:../dashboard/admin.php"); 
    } else { 
        header("location:../dashboard/guru.php"); 
    } 
}else{
    header("location:login.php?error=1");
} 
?> 