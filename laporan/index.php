<?php
include "../config/koneksi.php";
include "../auth/cek_session.php";
include "../layout/menu.php";

// Hitung total siswa
$query_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
$data_count = mysqli_fetch_assoc($query_count);
$total_siswa = $data_count['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Nilai - SIAKAD</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .page-header {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            text-align: center;
            margin-bottom: 0;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-title p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .stats-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .stats-info h5 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .stats-info p {
            margin: 0;
            opacity: 0.8;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 30px;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            margin: -30px -30px 20px -30px;
            border-bottom: none;
        }

        .card-header-custom h5 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        }

        .btn-print {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            margin-top: 20px;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            color: white;
            text-decoration: none;
        }

        .info-box {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #6c757d;
        }

        .info-box h6 {
            color: #495057;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .info-box p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "\f107";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            color: #6c757d;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .input-group .form-control:focus {
            border-left: none;
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2rem;
            }

            .content-card {
                padding: 20px;
            }

            .card-header-custom {
                margin: -20px -20px 20px -20px;
                padding: 15px;
            }

            .btn-print {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animation */
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

        .content-card, .stats-info {
            animation: fadeInUp 0.6s ease-out;
        }

        .info-box {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }
    </style>
</head>
<body>

    <div class="page-header">
        <div class="container">
            <div class="page-title">
                <h1><i class="fas fa-file-alt"></i> Laporan Nilai Siswa</h1>
                <p>Cetak rapor dan laporan akademik siswa</p>
                <div class="stats-info">
                    <h5>Total Siswa: <?= $total_siswa ?> Orang</h5>
                    <p>Siswa yang terdaftar dalam sistem</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <div class="card-header-custom">
                <h5><i class="fas fa-filter"></i> Filter Data Laporan</h5>
            </div>

            <div class="info-box">
                <h6><i class="fas fa-info-circle"></i> Informasi</h6>
                <p>Pilih data siswa, semester, dan tahun pelajaran untuk mencetak rapor nilai. Pastikan data nilai siswa sudah terinput dalam sistem.</p>
            </div>

            <form action="cetak.php" method="GET" target="_blank">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">
                            <i class="fas fa-user-graduate"></i> Pilih Siswa
                        </label>
                        <div class="select-wrapper">
                            <select name="nis" class="form-select" required>
                                <option value="">-- Cari Nama Siswa --</option>
                                <?php
                                $q_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                                while($s = mysqli_fetch_assoc($q_siswa)){
                                    echo "<option value='$s[nis]'>$s[nis] - $s[nama_siswa]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt"></i> Semester
                        </label>
                        <div class="select-wrapper">
                            <select name="semester" class="form-select" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-school"></i> Tahun Pelajaran
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="text" name="tapel" class="form-control"
                                   placeholder="Contoh: 2024/2025" required>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-print">
                        <i class="fas fa-print"></i> Cetak Rapor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include "../layout/footer.php"; ?>
</body>
</html>