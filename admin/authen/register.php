<?php
    session_start();
    require_once('process_form_register.php');

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
    <title>Đăng ký người dùng</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div class="container" style="max-width: 400px; background-color: #ffffff; border-radius: 10px; padding: 25px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Đăng ký người dùng</h2>
        <h4 style="color:red;" class="text-center"><?=$msg?></h4>
        <form method="POST" onsubmit="return validateForm()">
            <!-- Họ tên -->
            <div class="mb-3">
                <label for="fullname" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" required>
            </div>

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

            <!-- Xác nhận mật khẩu -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            </div>

            <div class="mb-3 text-center">
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </div>

            <!-- Nút đăng ký -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
        </form>
    </div>

<!-- VALIDATE FORM -->
<script type="text/javascript">
    function validateForm() {
        // Kiểm tra 2 trường nhập mật khẩu có giống nhau không
        let pwd = document.getElementById('password').value;
        let confirmPwd = document.getElementById('confirm_password').value;
        if (pwd !== confirmPwd) {
            alert("Mật khẩu không khớp, vui lòng kiểm tra lại!");
            return false;
        }
        return true;
    }
</script>

<!-- Link Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
