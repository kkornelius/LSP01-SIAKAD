<?php
include "../auth/cek_session.php";
include "../layout/menu.php";
include "../config/koneksi.php";

// Set zona waktu ke Jakarta
date_default_timezone_set('Asia/Jakarta');

if($_SESSION['level']!='admin'){
    die("Akses ditolak!");
}

// Ambil statistik data
$query_kompetensi = mysqli_query($conn, "SELECT COUNT(*) as total FROM kompetensi");
$data_kompetensi = mysqli_fetch_assoc($query_kompetensi);

$query_guru = mysqli_query($conn, "SELECT COUNT(*) as total FROM guru");
$data_guru = mysqli_fetch_assoc($query_guru);

$query_siswa = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
$data_siswa = mysqli_fetch_assoc($query_siswa);

$query_matpel = mysqli_query($conn, "SELECT COUNT(*) as total FROM matpel");
$data_matpel = mysqli_fetch_assoc($query_matpel);

$query_nilai = mysqli_query($conn, "SELECT COUNT(*) as total FROM nilai");
$data_nilai = mysqli_fetch_assoc($query_nilai);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - SIAKAD</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .welcome-content {
            text-align: center;
        }

        .welcome-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .welcome-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #3498db, #2980b9);
        }

        .stats-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stats-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stats-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .quick-actions {
            margin-bottom: 40px;
        }

        .action-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            display: block;
            height: 100%;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #3498db;
            color: #3498db;
            text-decoration: none;
        }

        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .action-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .action-desc {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .recent-activity {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #3498db;
        }

        @media (max-width: 768px) {
            .welcome-content h1 {
                font-size: 2rem;
            }

            .stats-card {
                margin-bottom: 20px;
            }

            .action-card {
                margin-bottom: 20px;
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

        .stats-card, .action-card, .recent-activity {
            animation: fadeInUp 0.6s ease-out;
        }

        .stats-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-card:nth-child(3) { animation-delay: 0.3s; }
        .stats-card:nth-child(4) { animation-delay: 0.4s; }
        .stats-card:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>

    <div class="welcome-section">
        <div class="container">
            <div class="welcome-content">
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
                <p>Selamat datang kembali, <strong><?= $_SESSION['username']; ?></strong>! Kelola sistem akademik dengan mudah.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="stats-card text-center">
                    <div class="stats-icon text-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-number text-primary"><?= $data_kompetensi['total'] ?></div>
                    <div class="stats-title">Kompetensi</div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="stats-card text-center">
                    <div class="stats-icon text-success">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stats-number text-success"><?= $data_guru['total'] ?></div>
                    <div class="stats-title">Guru</div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="stats-card text-center">
                    <div class="stats-icon text-info">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stats-number text-info"><?= $data_siswa['total'] ?></div>
                    <div class="stats-title">Siswa</div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="stats-card text-center">
                    <div class="stats-icon text-warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stats-number text-warning"><?= $data_matpel['total'] ?></div>
                    <div class="stats-title">Mata Pelajaran</div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="stats-card text-center">
                    <div class="stats-icon text-danger">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stats-number text-danger"><?= $data_nilai['total'] ?></div>
                    <div class="stats-title">Data Nilai</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3 class="mb-4 text-center"><i class="fas fa-bolt"></i> Akses Cepat</h3>
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../kompetensi/index.php" class="action-card">
                        <i class="fas fa-graduation-cap action-icon text-primary"></i>
                        <div class="action-title">Kompetensi</div>
                        <div class="action-desc">Kelola data kompetensi keahlian</div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../guru/index.php" class="action-card">
                        <i class="fas fa-chalkboard-teacher action-icon text-success"></i>
                        <div class="action-title">Data Guru</div>
                        <div class="action-desc">Kelola informasi guru</div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../siswa/index.php" class="action-card">
                        <i class="fas fa-user-graduate action-icon text-info"></i>
                        <div class="action-title">Data Siswa</div>
                        <div class="action-desc">Kelola data siswa</div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../matpel/index.php" class="action-card">
                        <i class="fas fa-book action-icon text-warning"></i>
                        <div class="action-title">Mata Pelajaran</div>
                        <div class="action-desc">Kelola mata pelajaran</div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../nilai/index.php" class="action-card">
                        <i class="fas fa-chart-line action-icon text-danger"></i>
                        <div class="action-title">Data Nilai</div>
                        <div class="action-desc">Kelola nilai siswa</div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <a href="../laporan/index.php" class="action-card">
                        <i class="fas fa-file-alt action-icon text-secondary"></i>
                        <div class="action-title">Laporan</div>
                        <div class="action-desc">Generate laporan</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-lg-6">
                <div class="recent-activity">
                    <h4 class="mb-4"><i class="fas fa-clock"></i> Aktivitas Terbaru</h4>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <strong>Sistem SIAKAD</strong> berhasil dimuat
                                <br><small class="text-muted">Hari ini, <?= date('H:i') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div>
                                <strong><?= $_SESSION['username'] ?></strong> login sebagai Admin
                                <br><small class="text-muted">Hari ini, <?= date('H:i') ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="recent-activity">
                    <h4 class="mb-4"><i class="fas fa-info-circle"></i> Informasi Sistem</h4>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon">
                                <i class="fas fa-server"></i>
                            </div>
                            <div>
                                <strong>Server Status:</strong> Online
                                <br><small class="text-muted">Sistem berjalan dengan baik</small>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div>
                                <strong>Database:</strong> Terhubung
                                <br><small class="text-muted">Koneksi database stabil</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../layout/footer.php"; ?>
 