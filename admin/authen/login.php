<?php
    session_start();
    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');
    require_once('process_form_login.php');

    $user = getUserToken();
    
    if ($user != null) {
        header('Location:../');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div class="container" style="max-width: 400px; background-color: #ffffff; border-radius: 10px; padding: 25px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Đăng nhập</h2>
        <h4 style="color:red;" class="text-center"><?=$msg?></h4>
        <form method="POST">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
            </div>

            <!-- Mật khẩu -->
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" minlength="6" required>
            </div>

            <div class="mb-3 text-center">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
            </div>

            <!-- Nút đăng nhập -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
