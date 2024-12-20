<?php
    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');
    $fullname = $email = $msg ='';
    if (!empty($_POST)) { // kiểm tra xem post có dữ liệu đẩy lên k
        //nếu có thì lấy các trường dữ liệu bên dưới
        $fullname = getPost('fullname');
        $email = getPost('email');
        $pwd = getPost('password');

        //validate
        if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd)<6) {
            //kiểm tra các trường trống và mk
        } else {
            //validate thành công
            $userExist = executeResult("SELECT * FROM user where email = '$email'",true);
            if($userExist != NULL) {
                $msg = 'Email đã được đăng ký trên hệ thống';
            } else {
                $created_at = $updated_at = date('Y-m-d H:i:s');
                $pwd = getSecurityMD5($pwd);

                $sql = "insert into user(fullname, email, password, role_id, created_at, updated_at, deleted)
                        values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
                execute($sql);
                header('Location: login.php');
                die();
            }
        }
    }
?>