<?php 
include "../config/koneksi.php"; 
include "../auth/cek_session.php";
include "../layout/menu.php";
?> 

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <title>Tambah Nilai - SIAKAD</title> 
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
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
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
            color: #e74c3c;
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
            border-color: #e74c3c;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #adb5bd;
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
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
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
                <h1><i class="fas fa-chart-line"></i> Input Nilai Baru</h1>
                <p>Tambahkan data nilai siswa ke dalam sistem</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="post"> 
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nama Siswa</label>
                        <select name="nis" class="form-select" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php 
                            $q_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                            while($s = mysqli_fetch_assoc($q_siswa)){
                                echo "<option value='$s[nis]'>$s[nis] - $s[nama_siswa]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-book"></i> Mata Pelajaran</label>
                        <select name="kd_matpel" class="form-select" required>
                            <option value="">-- Pilih Matpel --</option>
                            <?php 
                            $q_matpel = mysqli_query($conn, "SELECT * FROM matpel ORDER BY nama_matpel ASC");
                            while($m = mysqli_fetch_assoc($q_matpel)){
                                echo "<option value='$m[kd_matpel]'>$m[nama_matpel]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-brain"></i> Nilai Pengetahuan (P)</label>
                        <input type="number" step="0.01" name="nilai_p" class="form-control" placeholder="0-100" required> 
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-tools"></i> Nilai Keterampilan (K)</label>
                        <input type="number" step="0.01" name="nilai_k" class="form-control" placeholder="0-100" required> 
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt"></i> Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-school"></i> Tahun Pelajaran</label>
                        <input type="text" name="tapel" class="form-control" placeholder="Contoh: 2023/2024" required> 
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
    mysqli_query($conn,"INSERT INTO nilai (nis, kd_matpel, nilai_p, nilai_k, semester, tapel) VALUES( 
        '$_POST[nis]', 
        '$_POST[kd_matpel]', 
        '$_POST[nilai_p]', 
        '$_POST[nilai_k]', 
        '$_POST[semester]', 
        '$_POST[tapel]'
    )"); 
    echo "<script>alert('Data nilai tersimpan');location='index.php';</script>"; 
} 
?>