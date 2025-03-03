
<?php
    require_once('config.php');
	require_once('database/config.php');
    require_once('database/dbhelper.php');
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username='".$username."' AND password='".$password."' LIMIT 1";
		$row = mysqli_query($mysqli,$sql);
		$count = mysqli_num_rows($row);
		if($count > 0){
      $user = mysqli_fetch_assoc($row);
      if ($user['role'] == 'admin'){
        // $_SESSION['submit'] = $username;
        echo '<script>alert("Chào mừng đến trang quản trị!");
        window.location.href="index.php";
        </script>';
        $username = trim(strip_tags($_POST['username']));
        $password = trim(strip_tags($_POST['password']));
        session_start();
        setcookie("username", $username, time() + 30 * 24 * 60 * 60, '/');
        setcookie("password", $password, time() + 30 * 24 * 60 * 60, '/');
      }
      else {
        // $_SESSION['submit'] = $username;
        echo '<script>alert("Đăng nhập thành công.");
          window.location.href="index.php";
          </script>';
        session_start();
        setcookie("username", $username, time() + 30 * 24 * 60 * 60, '/');
        setcookie("password", $password, time() + 30 * 24 * 60 * 60, '/');
      }
		}
        else{
			echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng,vui lòng nhập lại.");</script>';
		}
  }
?>

<?php 
 include("Layout/header.php");
?>
<!-- pages-title-start -->
<section class="contact-img-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="con-text">
          <h2 class="page-title">Đăng nhập</h2>
          <p><a href="#">Trang chủ</a> | Đăng nhập</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login content section start -->
<div class="login-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="tb-login-form ">
          <h5 class="tb-title">Đăng nhập</h5>
          <p>Đăng nhập tài khoản để trải nghiệm mua sắm tại Luxury Home</p>
          <form action="#" method="POST">
            <p class="checkout-coupon top log a-an">
              <label class="l-contact">
                Tên đăng nhập
                <em>*</em>
              </label>
              <input type="text" name="username" required>
            </p>
            <p class="checkout-coupon top-down log a-an">
              <label class="l-contact">
                Mật khẩu
                <em>*</em>
              </label>
              <input type="password" name="password" required>
            </p>
            
            <div class="forgot-password1">
              <label class="inline2">
                <input type="checkbox" name="rememberme7">
                Ghi nhớ! <em>*</em>
              </label>
              <a class="forgot-password" href="#">Quên mật khẩu?</a>
            </div>
            <p class="login-submit5">
              <input class="button-primary" type="submit" name="submit" value="Đăng nhập">
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="opacity-20">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php require_once('Layout/footer.php'); ?>