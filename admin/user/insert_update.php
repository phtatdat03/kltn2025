<?php
    $title = 'Form thêm/sửa người dùng';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');
    $id = $msg = $fullname = $email = $phone_number = $address = $role_id ='';
    require_once('form_save.php');

    //lấy id tài khoản người dùng để lấy thông tin của tài khoản, nếu mã tồn tại fill vào form chỉnh sửa
    $id = getGet('id');
    if($id != '' && $id > 0) {
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $userItem = executeResult($sql, true);
        if($userItem != null) {
            $fullname = $userItem['fullname'];
            $email = $userItem['email'];
            $phone_number = $userItem['phone_number'];
            $address = $userItem['address'];
            $role_id = $userItem['role_id'];
        } else {
            $id = 0; //trường hợp k tìm thấy id thì sẽ xóa id
        }
    } else {$id = 0;}

    $sql = "SELECT * FROM role";
    $roleItems = executeResult($sql); // chứa danh sách các quyền trong hệ thống

?>
        
        <div id="page-content-wrapper">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Thêm/Sửa người dùng</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle second-text fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>                                      
                                    <a href="<?=$baseUrl?>authen/logout.php" class="dropdown-item">Thoát</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navbar -->

            <!-- page content -->
            <div class="container">
                <h4 style="color:red;" class="text-center"><?=$msg?></h4>
                    <form method="POST" onsubmit="return validateForm()">
                        <!-- Họ tên -->
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ tên:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" value="<?=$fullname?>" required>
                        </div>
                        <input type="text" name="id" value="<?=$id?>" hidden="true">
                        <!-- Quyền -->
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Role:</label>
                            <select class="form-control" name="role_id" id="role_id" required="true">
                                <option value="">-- Chọn --</option>
                                <?php
                                    foreach ($roleItems as $role) {
                                        if($role['id'] == $role_id) {
                                            echo '<option selected value="'.$role['id'].'">'.$role['name'].'</option>'; 
                                        } else {
                                            echo '<option value="'.$role['id'].'">'.$role['name'].'</option>'; 
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?=$email?>" required>
                        </div>

                        <!-- Điện thoại -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">SĐT:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Nhập SĐT" value="<?=$phone_number?>" required>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="<?=$address?>" required>
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" minlength="6" <?=($id > 0 ? '' : 'required="true"')?>>
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" <?=($id > 0 ? '' : 'required="true"')?>>
                        </div>

                        <!-- Nút đăng ký -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
            </div>
            <!-- page content -->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    var el = document.getElementById("wrapper")
    var toggleButton = document.getElementById("menu-toggle")

    toggleButton.onclick = function () {
        el.classList.toggle("toggled")
    }
</script>
</body>
</html>