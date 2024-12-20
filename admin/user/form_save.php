<?php

if (!empty($_POST)) {
    $id = getPost("id"); 
    $fullname = getPost('fullname');
    $email = getPost('email');
    $phone_number = getPost('phone_number');
    $address = getPost('address');
    $password = getPost('password');
    if ($password != '') { //nếu password khác rỗng thì mới chạy md5, nếu vẫn để password rỗng thì md5 sẽ chạy ra 1 chuỗi vô nghĩa
        $password = getSecurityMD5($password); // mã hóa password
    }
    $created_at = $updated_at = date("Y-m-d H:i:s");
    $role_id = getPost('role_id');

    if($id > 0) {// nếu id lớn hơn 0 - cập nhật người dùng
        //update
        // câu lệnh sql truy vấn tìm xem có email nào trùng nhưng không phải của người dùng hiện tại đang đc chỉnh sửa
        // để tránh 2 người dùng có chung email
        $sql = "select * from user where email = '$email' and id <> $id"; 
        $userItem = executeResult($sql, true);

        if ($userItem != null) { 
            $msg = 'Email đã được đăng ký!';
        } else {
            if ($password != '') { // nếu mk được nhập thì cập nhật cả mật khẩu
                $sql = "UPDATE user set fullname = '$fullname', email='$email', phone_number='$phone_number'
                ,address='$address', password='$password', updated_at = '$updated_at', role_id = '$role_id'
                where id = '$id'";
            } else { // nếu mk không được nhập thì giữ nguyên
                $sql = "UPDATE user set fullname = '$fullname', email='$email', phone_number='$phone_number'
                ,address='$address', updated_at = '$updated_at', role_id = '$role_id'
                where id = '$id'";
            }
            execute($sql);
            header('Location: index.php');
            die();
        }
    } else { // nếu id bằng 0 hoặc rỗng - thêm mới người dùng
        //insert
        if ($userItem == NULL) {
            //kiểm tra đã tồn tại user này chưa trong database, nếu chưa thì insert
            $sql = "INSERT INTO user(fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted)
            values ('$fullname', '$email', '$phone_number', '$address', '$password', '$role_id', '$created_at', '$updated_at', 0)";
            execute($sql);
            //sau khi thêm thành công thì chuyển về trang hiển thị dnah sách user
            header('Location: index.php');
            die();
        } else {
            //nếu đã tồn tại rồi, hiện thông báo lỗi
            $msg = 'Email đã được đăng ký, vui lòng kiêm tra lại!';
        }
    }

}