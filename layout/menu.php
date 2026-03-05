<?php 
$level = $_SESSION['level']; 
?>

<style>
    body {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .sidebar-brand {
        padding: 20px;
        text-align: center;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 30px;
    }

    .sidebar-brand a {
        font-size: 28px;
        font-weight: bold;
        color: white;
        text-decoration: none;
        display: block;
    }

    .sidebar-brand a:hover {
        color: #3498db;
    }

    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-menu li {
        margin: 0;
    }

    .nav-menu a {
        display: block;
        padding: 15px 20px;
        color: #ecf0f1;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        font-size: 15px;
    }

    .nav-menu a:hover {
        background-color: rgba(52, 152, 219, 0.2);
        border-left-color: #3498db;
        color: #3498db;
        padding-left: 25px;
    }

    .nav-menu a.active {
        background-color: #3498db;
        border-left-color: #2980b9;
        color: white;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        border-top: 2px solid rgba(255, 255, 255, 0.1);
        background: rgba(0, 0, 0, 0.2);
    }

    .user-info {
        margin-bottom: 15px;
        padding: 10px;
        background-color: rgba(52, 152, 219, 0.2);
        border-radius: 5px;
    }

    .user-info p {
        margin: 5px 0;
        color: #ecf0f1;
        font-size: 13px;
    }

    .user-info strong {
        color: #3498db;
    }

    .btn-logout {
        width: 100%;
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-logout:hover {
        background-color: #c0392b;
        color: white;
        text-decoration: none;
    }

    .main-content {
        margin-left: 280px;
        width: calc(100% - 280px);
        height: 100vh;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }

        .main-content {
            margin-left: 200px;
            width: calc(100% - 200px);
        }
    }

    /* Scrollbar styling */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<div class="sidebar">
    <div class="sidebar-brand">
        <a href="#">SIAKAD</a>
    </div>

    <ul class="nav-menu">
        <?php if($level=='admin'){ ?>
            <li><a href="../dashboard/admin.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active' : '' ?>">📊 Dashboard</a></li>
            <li><a href="../kompetensi/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'kompetensi') ? 'active' : '' ?>">🎯 Kompetensi</a></li>
            <li><a href="../guru/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'guru') ? 'active' : '' ?>">👨‍🏫 Guru</a></li>
            <li><a href="../siswa/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'siswa') ? 'active' : '' ?>">👨‍🎓 Siswa</a></li>
            <li><a href="../matpel/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'matpel') ? 'active' : '' ?>">📚 Mata Pelajaran</a></li>
            <li><a href="../nilai/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'nilai') ? 'active' : '' ?>">📝 Nilai</a></li>
            <li><a href="../laporan/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'laporan') ? 'active' : '' ?>">📄 Laporan</a></li>
        <?php } ?>

        <?php if($level=='guru'){ ?>
            <li><a href="../dashboard/guru.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'guru.php') ? 'active' : '' ?>">📊 Dashboard</a></li>
            <li><a href="../nilai/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'nilai') ? 'active' : '' ?>">✏️ Input Nilai</a></li>
            <li><a href="../laporan/index.php" class="<?= (basename(dirname($_SERVER['PHP_SELF'])) == 'laporan') ? 'active' : '' ?>">📊 Laporan Nilai</a></li>
        <?php } ?>
    </ul>

    <div class="sidebar-footer">
        <div class="user-info">
            <p><strong>Pengguna:</strong></p>
            <p><?= $_SESSION['username']; ?></p>
            <p><strong>Level:</strong></p>
            <p><?= ucfirst($level); ?></p>
        </div>
        <a href="../auth/logout.php" class="btn-logout">🚪 Logout</a>
    </div>
</div>

<div class="main-content"> 