<?php
include "../config/koneksi.php";
include "../auth/cek_session.php";
include "../layout/menu.php";

// Hitung total data
$query_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM nilai");
$data_count = mysqli_fetch_assoc($query_count);
$total_data = $data_count['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Nilai - SIAKAD</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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

        .btn-add {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
            color: white;
            text-decoration: none;
        }

        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .btn-action {
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h4 {
            margin-bottom: 10px;
        }

        .empty-state p {
            margin-bottom: 30px;
        }

        .grade-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-align: center;
            min-width: 50px;
            display: inline-block;
        }

        .grade-excellent {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
        }

        .grade-good {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        .grade-average {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .grade-poor {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
        }

        .semester-badge {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2rem;
            }

            .content-card {
                padding: 20px;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .btn-action {
                padding: 4px 8px;
                font-size: 0.8rem;
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
    </style>
</head>
<body>

    <div class="page-header">
        <div class="container">
            <div class="page-title">
                <h1><i class="fas fa-chart-line"></i> Data Nilai Siswa</h1>
                <p>Kelola nilai akademik dan rapor siswa</p>
                <div class="stats-info">
                    <h5>Total Data: <?= $total_data ?> Nilai</h5>
                    <p>Data nilai yang telah diinput dalam sistem</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="fas fa-list"></i> Daftar Nilai Siswa</h4>
                <a href="tambah.php" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Nilai
                </a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%"><i class="fas fa-hashtag"></i> No</th>
                            <th width="20%"><i class="fas fa-user"></i> Nama Siswa</th>
                            <th width="20%"><i class="fas fa-book"></i> Mata Pelajaran</th>
                            <th width="12%"><i class="fas fa-brain"></i> Pengetahuan</th>
                            <th width="12%"><i class="fas fa-tools"></i> Keterampilan</th>
                            <th width="8%"><i class="fas fa-calendar-alt"></i> Semester</th>
                            <th width="10%"><i class="fas fa-school"></i> Tapel</th>
                            <th width="13%"><i class="fas fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fungsi untuk menentukan grade berdasarkan nilai
                        function getGradeClass($nilai) {
                            if ($nilai >= 85) return 'grade-excellent';
                            if ($nilai >= 70) return 'grade-good';
                            if ($nilai >= 55) return 'grade-average';
                            return 'grade-poor';
                        }

                        $no = 1;
                        $query = mysqli_query($conn, "
                            SELECT n.*, s.nama_siswa, m.nama_matpel
                            FROM nilai n
                            JOIN siswa s ON n.nis = s.nis
                            JOIN matpel m ON n.kd_matpel = m.kd_matpel
                            ORDER BY s.nama_siswa ASC
                        ");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($row['nama_siswa']) ?></strong>
                                </td>
                                <td>
                                    <i class="fas fa-book text-warning me-2"></i>
                                    <?= htmlspecialchars($row['nama_matpel']) ?>
                                </td>
                                <td>
                                    <span class="grade-badge <?= getGradeClass($row['nilai_p']) ?>">
                                        <?= htmlspecialchars($row['nilai_p']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="grade-badge <?= getGradeClass($row['nilai_k']) ?>">
                                        <?= htmlspecialchars($row['nilai_k']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="semester-badge">
                                        <?= htmlspecialchars($row['semester']) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?= htmlspecialchars($row['tapel']) ?>
                                    </small>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $row['kd_nilai'] ?>" class="btn-action btn-edit me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="hapus.php?id=<?= $row['kd_nilai'] ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data nilai ini?')"
                                       class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($total_data == 0) {
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fas fa-chart-line"></i>
                                        <h4>Belum Ada Data</h4>
                                        <p>Data nilai siswa belum tersedia. Silakan tambahkan data baru.</p>
                                        <a href="tambah.php" class="btn-add">
                                            <i class="fas fa-plus"></i> Tambah Data Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "../layout/footer.php"; ?>
</body>
</html>