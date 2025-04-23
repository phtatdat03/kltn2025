<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
?>
<?php 
include("Layout/header.php");
?>
<?php
include('config.php');
if (isset($_POST['dangky'])) {
    $fullname   = trim($_POST['hovaten']);
    $tendangnhap = trim($_POST['tendangnhap']);
    $email      = trim($_POST['email']);
    $diachi     = trim($_POST['diachi']);
    $matkhau    = trim($_POST['matkhau']);
    $dienthoai  = trim($_POST['dienthoai']);
    
    if (!empty($fullname) && !empty($tendangnhap) && !empty($email) && !empty($diachi) && !empty($dienthoai) && !empty($matkhau)) {
        // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại hay chưa
        $sql_check = "SELECT * FROM user WHERE username = '$tendangnhap' OR email = '$email'";
        $result_check = mysqli_query($mysqli, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo '<script>alert("Tên đăng nhập hoặc Email đã tồn tại.");</script>';
        } else {
            $sql_dangky = "INSERT INTO user(full_name, username, email, address, password, phone_number) 
                           VALUES('$fullname', '$tendangnhap', '$email', '$diachi', '$matkhau', '$dienthoai')";
            if (mysqli_query($mysqli, $sql_dangky)) {
                echo '<script>alert("Đăng ký thành công.");
                      window.location.href="login.php";
                      </script>';
            } else {
                echo '<script>alert("Đăng ký thất bại. Vui lòng thử lại.");</script>';
            }
        }
    } else {
        echo '<script>alert("Vui lòng điền đầy đủ thông tin.");</script>';
    }
}
?>

<section class="contact-img-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="con-text">
          <h2 class="page-title">ĐĂNG KÝ</h2>
          <p><a href="#">Trang chủ</a> | Đăng ký</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="login-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="tb-login-form ">
          <h5 class="tb-title">Đăng ký</h5>
          <p>Đăng ký tài khoản để có thể mua sắm tại Luxury Home</p>
          <form action="#" method="POST">
            <p class="checkout-coupon top log a-an">
              <label class="l-contact">
                Họ và tên
                <em>*</em>
              </label>
              <input type="text" name="hovaten" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
                Tên đăng nhập
                <em>*</em>
              </label>
              <input type="text" name="tendangnhap" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
                Email
                <em>*</em>
              </label>
              <input type="text" name="email" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
              Số điện thoại
                <em>*</em>
              </label>
              <input type="text" name="dienthoai" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
                Mật khẩu
                <em>*</em>
              </label>
              <input type="password" name="matkhau" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
                Địa chỉ
                <em>*</em>
              </label>
              <input type="text" name="diachi" required>
            </p>
            <p class="login-submit5">
              <input class="button-primary" type="submit" name="dangky" value="Đăng ký">
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="opacity-20">
<?php require_once('Layout/footer.php'); ?>