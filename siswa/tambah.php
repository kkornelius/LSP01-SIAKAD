<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
?> 

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <title>Tambah Siswa - SIAKAD</title> 
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
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
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
            max-width: 700px;
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
            color: #3498db;
            font-size: 1rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            justify-content: center;
        }

        .btn-submit {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
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

            .form-row {
                grid-template-columns: 1fr;
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
                <h1><i class="fas fa-user-graduate"></i> Tambah Siswa Baru</h1>
                <p>Tambahkan data siswa baru ke dalam sistem</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="post"> 
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-id-card"></i> NIS</label>
                        <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa" required> 
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Lengkap" required> 
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota" required> 
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required> 
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-home"></i> Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat lengkap" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="08xx-xxxx-xxxx" required> 
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-graduation-cap"></i> Kompetensi Keahlian</label>
                        <select name="kd_kompetensi" class="form-select" required> 
                            <option value="">-- Pilih Kompetensi --</option> 
                            <?php 
                            $q_kom = mysqli_query($conn, "SELECT * FROM kompetensi"); 
                            while($k = mysqli_fetch_assoc($q_kom)){ 
                                echo "<option value='$k[kd_kompetensi]'>$k[nama_kompetensi]</option>"; 
                            } 
                            ?> 
                        </select> 
                    </div>
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
if(isset($_POST['simpan'])){ 
    $simpan = mysqli_query($conn,"INSERT INTO siswa VALUES( 
        '$_POST[nis]', 
        '$_POST[nama_siswa]', 
        '$_POST[tempat_lahir]', 
        '$_POST[tgl_lahir]', 
        '$_POST[alamat]', 
        '$_POST[no_telepon]',
        '$_POST[kd_kompetensi]'
    )"); 

    if($simpan){
        echo "<script>alert('Data siswa berhasil disimpan');location='index.php';</script>"; 
    } else {
        echo "<script>alert('Gagal menyimpan data (Cek duplikasi NIS)');</script>";
    }
} 
?>