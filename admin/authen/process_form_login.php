<?php

$fullname = $email = $msg = '';

if (!empty($_POST)) {
    $email = getPost('email');
    $pwd = getPost('password');
    $pwd = getSecurityMD5($pwd);

    $sql = "select * from user where email = '$email' and password = '$pwd' and deleted = 0";
    // nếu tài khoản đã bị xóa (trường deleted = 1 thì k cho login)
    $userExist = executeResult($sql,true);

    if ($userExist == NULL) {
        $msg = "Đăng nhập không thành công! Vui lòng kiểm tra lại email hoặc mật khẩu!";
    } else {
                                // tạo token cho tài khoản và lưu vào db
        $token = getSecurityMD5($userExist['email'].time()); //email người dùng + thời gian hiện tại
        //tạo biến token cho tài khoản đang đăng nhập và thời gian tài khoản đó đăng nhập
        setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
        // lưu token vào cookie và token này tồn tại trong 1 tuần và đảm bảo hoạt động trên toàn bô trang web
        $created_at = date('Y-m-d H:i:s');
        $_SESSION['user'] = $userExist;
        $userID = $userExist['id']; // lưu thông tin của người dfung đã đăng nhập vào session
        // lưu vào db
        $sql = "insert into tokens (user_id, token, created_at)
                values ('$userID', '$token', '$created_at')";
        execute($sql);

        header('Location: ../');
        die();
    }
}

?>