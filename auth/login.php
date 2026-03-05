<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - SIAKAD</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .login-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 40px 30px 30px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 18px;
            z-index: 2;
        }

        .form-control {
            padding: 15px 15px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.3);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            padding: 0 30px 30px 30px;
            color: #6c757d;
            font-size: 14px;
        }

        .login-footer i {
            color: #3498db;
            margin-right: 5px;
        }

        /* Floating animation for background */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .login-card {
            animation: float 6s ease-in-out infinite;
        }

        /* Responsive design */
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }

            .login-header {
                padding: 25px 15px;
            }

            .login-header h2 {
                font-size: 24px;
            }

            .login-body {
                padding: 30px 20px 20px 20px;
            }
        }

        /* Error message styling */
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-graduation-cap"></i> SIAKAD</h2>
                <p>Sistem Informasi Akademik Sekolah</p>
            </div>

            <div class="login-body">
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        Username atau password salah!
                    </div>
                <?php endif; ?>

                <form action="cek_login.php" method="post">
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
                    </button>
                </form>
            </div>

            <div class="login-footer">
                <i class="fas fa-shield-alt"></i>
                Sistem ini hanya untuk pengguna terdaftar
            </div>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html> 