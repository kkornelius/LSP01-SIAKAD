<?php
include "../config/koneksi.php";
include "../auth/cek_session.php";
include "../layout/menu.php";

// Hitung total data
$query_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM kompetensi");
$data_count = mysqli_fetch_assoc($query_count);
$total_data = $data_count['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Kompetensi - SIAKAD</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                <h1><i class="fas fa-graduation-cap"></i> Data Kompetensi</h1>
                <p>Kelola data kompetensi keahlian sekolah</p>
                <div class="stats-info">
                    <h5>Total Data: <?= $total_data ?> Kompetensi</h5>
                    <p>Data kompetensi keahlian yang terdaftar dalam sistem</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="fas fa-list"></i> Daftar Kompetensi</h4>
                <a href="tambah.php" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Kompetensi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%"><i class="fas fa-hashtag"></i> No</th>
                            <th width="15%"><i class="fas fa-code"></i> Kode</th>
                            <th width="30%"><i class="fas fa-graduation-cap"></i> Nama Kompetensi</th>
                            <th width="30%"><i class="fas fa-certificate"></i> Program Keahlian</th>
                            <th width="20%"><i class="fas fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM kompetensi ORDER BY kd_kompetensi ASC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        <?= htmlspecialchars($row['kd_kompetensi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($row['nama_kompetensi']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($row['prog_keahlian']) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['kd_kompetensi'] ?>" class="btn-action btn-edit me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="hapus.php?id=<?= $row['kd_kompetensi'] ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus kompetensi ini?')"
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
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-graduation-cap"></i>
                                        <h4>Belum Ada Data</h4>
                                        <p>Data kompetensi keahlian belum tersedia. Silakan tambahkan data baru.</p>
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
</body> 
</html> 