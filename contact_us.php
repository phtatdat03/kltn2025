
<?php
    session_start();
    include('config.php');
    require_once('database/dbhelper.php');
  if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message_contact = $_POST['message_contact'];
    $created_at = date('Y-m-d H:s:i');
    if (isset($_COOKIE['username'])) {
      $username = $_COOKIE['username'];
      $sql = "SELECT * FROM user WHERE username = '$username'";
      $user = executeResult($sql);
      foreach ($user as $item) {
          $userId = $item['id_user'];
      }
    } else{
      $userId = "";
    }
    
    if(empty($fullname) || empty($email) || empty($message_contact)) {
      echo 'Vui lòng nhập đầy đủ thông tin!';
      exit;
      } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo 'Vui lòng nhập đúng định dạng email!';
      exit;
      }
    
		else{
      if(isset($_COOKIE['username'])){
        if($fullname!="" && $email!="" &&  $message_contact!=""){
          $sql = mysqli_query($mysqli,"INSERT INTO contact(fullname,email,message_contact,id_user,created_at) VALUE('".$fullname."','".$email."','".$message_contact."','".$userId."','".$created_at."')");
                  echo '<script>alert("Gửi liên hệ thành công.");
                  window.location.href="index.php";
                  </script>';
                  
        } 
      } else {
        if($fullname!="" && $email!="" &&  $message_contact!=""){
          $sql = mysqli_query($mysqli,"INSERT INTO contact(fullname,email,message_contact,created_at) VALUE('".$fullname."','".$email."','".$message_contact."','".$created_at."')");
                  echo '<script>alert("Gửi liên hệ thành công.");
                  window.location.href="index.php";
                  </script>';
        }
      }
			
		
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
            <h2 class="page-title">LIÊN HỆ</h2>
            <p><a href="#">Trang chủ</a> | Liên hệ</p>
          </div>
        </div>
    </div>
  </div>
</section>
<body >
<hr class="opacity-20">
  <div class="container">
    <div class="title">Liên hệ</div>
    <div class="content">
      <form action="#" method="POST">
        <div class="user-details">
          <?php
            if(isset($_COOKIE['username'])){
            echo '<p style="font-weight: bold; text-align: center; font-size: 16px;">Xin chào ' . $_COOKIE['username'] . '</p>';
          } else {
            echo '<p style="font-weight: bold; text-align: center; font-size: 16px;">Chào bạn! Nếu có bất kỳ vấn đề cần hỗ trợ, hãy liên hệ với chúng tôi qua biểu mẫu.</p>';} 
            ?>
          <div class="input-box">
            <span class="details">Họ và tên</span>
            <input type="text" name="fullname"  placeholder="Nhập tên của bạn" required>
          </div>
          
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Nhập email của bạn" required>
          </div>
          
          <div class="input-box">
            <span class="details">Tin nhắn</span>
            <textarea type="text" name="message_contact" placeholder="Nhập tin nhắn của bạn" required> </textarea>
          </div>
          
        </div>
        
        <div class="button">
          <input type="submit" name="submit" value="Gửi">
        </div>
      </form>
    </div>
  </div>



<style>

.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, black,red);
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  display: block;
  margin: 20px auto;
  border: 0;
  border-radius: 5px;
  padding: 1px 10px;
  width: 100%;
  outline: none;
  color: #000000;
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.input-box  textarea {
  
  height: 75px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
  
}
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #9b59b6;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: #9b59b6;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color:white;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: black;
 }
 form .button input:hover{background: orange;}

</style></body>

</html>
<?php 
include("Layout/footer.php"); 
?>