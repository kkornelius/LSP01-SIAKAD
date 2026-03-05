<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <title>Tambah Kompetensi - SIAKAD</title> 
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 30px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            text-align: center;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-title p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 0.6s ease-out;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .form-group label i {
            color: #9b59b6;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #9b59b6;
            box-shadow: 0 0 0 0.2rem rgba(155, 89, 182, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            justify-content: center;
        }

        .btn-submit {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(155, 89, 182, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(155, 89, 182, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-back {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2rem;
            }

            .form-container {
                padding: 25px;
                margin: 0 15px;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-submit, .btn-back {
                width: 100%;
                justify-content: center;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head> 
<body> 
    <div class="page-header">
        <div class="container">
            <div class="page-title">
                <h1><i class="fas fa-book"></i> Tambah Kompetensi</h1>
                <p>Tambahkan kompetensi keahlian baru ke sistem</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="post"> 
                <div class="form-group"> 
                    <label><i class="fas fa-code"></i> Kode Kompetensi</label> 
                    <input type="text" name="kd_kompetensi" class="form-control" placeholder="Misal: K001" required> 
                </div> 
 
                <div class="form-group"> 
                    <label><i class="fas fa-graduation-cap"></i> Nama Kompetensi</label> 
                    <input type="text" name="nama_kompetensi" class="form-control" placeholder="Nama kompetensi" required> 
                </div> 
 
                <div class="form-group"> 
                    <label><i class="fas fa-briefcase"></i> Program Keahlian</label> 
                    <input type="text" name="prog_keahlian" class="form-control" placeholder="Program keahlian" required> 
                </div> 
 
                <div class="btn-group">
                    <button name="simpan" type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan</button> 
                    <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a> 
                </div>
            </form>
        </div>
    </div>

    <?php include "../layout/footer.php"; ?>
</body> 
</html>

<?php 
if (isset($_POST['simpan'])) { 
    mysqli_query($conn, "INSERT INTO kompetensi VALUES ( 
        '$_POST[kd_kompetensi]', 
        '$_POST[nama_kompetensi]', 
        '$_POST[prog_keahlian]' 
    )"); 
    echo "<script>alert('Data berhasil disimpan');location='index.php';</script>"; 
} 
?>