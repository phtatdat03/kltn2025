<?php 
    session_start();
	if(!isset($_COOKIE['tendangnhap_admin'])){
		header('Location: login.php');
	}
 ?>
<?php require_once('database/dbhelper.php'); ?>
<?php
header("content-type:text/html; charset=UTF-8");
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Đơn Hàng</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" type="image/png" href="../images/logo1.png">
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScrseipt -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="../script.js"></script>
</head>

<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
  <!-- Vertical Navbar -->
  <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
        <h3 class="text-success"><img src="/Web/images/logo1.png" width="40" ><span class="text-info">LUXURY</span>HOME</h3> 
      </a>
      <!-- User menu (mobile) -->
      <div class="navbar-user d-lg-none">
        <!-- Dropdown -->
        <div class="dropdown">
          <!-- Toggle -->
          <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="avatar-parent-child">
              <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
              <span class="avatar-child avatar-badge bg-success"></span>
            </div>
          </a>
          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
            <a href="#" class="dropdown-item">Hồ sơ</a>
            <a href="#" class="dropdown-item">Cài đặt</a>
            <a href="#" class="dropdown-item">Hóa đơn</a>
            <hr class="dropdown-divider">
            <a href="#" class="dropdown-item">Đăng xuất</a>
          </div>
        </div>
      </div>
      <!-- Divider -->
      <hr class="navbar-divider my-18 opacity-20">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidebarCollapse">
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="bi bi-speedometer2"></i> Quản lý Liên Hệ
            </a>
          </li>
          <hr class="navbar-divider my-3 opacity-20">
          <li class="nav-item">
            <a class="nav-link" href="product/index.php">
              <i class="bi bi-bag-heart"></i>Quản Lý Sản Phẩm
            </a>
          </li>
          <!-- Divider -->
          <hr class="navbar-divider my-3 opacity-20">
          <li class="nav-item">
            <a class="nav-link" href="user/index.php">
              <i class="bi bi-person-check"></i>Quản Lý Khách Hàng
            </a>
          </li>
          <hr class="navbar-divider my-3 opacity-20">
          <li class="nav-item">
            <a class="nav-link" href="order.php">
              <i class="bi bi-cash-stack"></i>Quản Lý Đơn Hàng
            </a>
          </li>
          <hr class="navbar-divider my-3 opacity-20">
          <li class="nav-item">
            <a class="nav-link" href="category/index.php">
              <i class="bi bi-bag-heart"></i>Quản Lý Danh Mục
            </a>
          </li>
          <hr class="navbar-divider my-3 opacity-20">
          <li class="nav-item">
            <a class="nav-link" href="collection/index.php">
              <i class="bi bi-collection"></i>Quản Lý Thương Hiệu
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="navbar-divider my-18 opacity-20">

        <!-- Push content down -->
        <div class="mt-auto"></div>
        <!-- User (md) -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="bi bi-house-heart-fill"></i></i> Trang chủ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">
              <i class="bi bi-box-arrow-left"></i> Đăng xuất
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6">
      <div class="container-fluid">
        <div class="mb-npx">
          <div class="row align-items-center">
            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
              <!-- Title -->
              <h1 class="h2 mb-0 ls-tight">
                <img src="/Web/images/logo1.png" width="60"> Luxury Home</h1>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
      <div class="container-fluid">
        <!-- Card stats -->
        <div class="row g-6 mb-6">
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                      <span class="h6 font-semibold text-muted text-sm d-block mb-2">Sản Phẩm</span>
                      
                      <span class="h3 font-bold mb-0">
                          <?php
                      $sql = "SELECT * FROM `product`";
                      $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                      $result = mysqli_query($conn, $sql);
                      echo '<span>' . mysqli_num_rows($result) . '</span>';
                      ?>
                      </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                      <i class="bi bi-credit-card"></i>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Khách Hàng</span>
                    <span class="h3 font-bold mb-0">
                      <?php
                      $sql = "SELECT * FROM `user`";
                      $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                      $result = mysqli_query($conn, $sql);
                      echo '<span>' . mysqli_num_rows($result) . '</span>';
                      ?>
                    </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                      <i class="bi bi-people"></i>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                      <span class="h6 font-semibold text-muted text-sm d-block mb-2">Đơn Hàng</span>
                      <span class="h3 font-bold mb-0">
                          <?php
                          $sql = "SELECT * FROM `order_details`";
                          $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                          $result = mysqli_query($conn, $sql);
                          echo '<span>' . mysqli_num_rows($result) . '</span>';
                          ?>
                      </span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                      <i class="bi bi-clock-history"></i>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                    <div class="col">
                      <span class="h6 font-semibold text-muted text-sm d-block mb-2">Danh Mục</span>
                      <span class="h3 font-bold mb-0">
                        <?php
                        $sql = "SELECT * FROM `category`";
                        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                        $result = mysqli_query($conn, $sql);
                        echo '<span>' . mysqli_num_rows($result) . '</span>';
                        ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                        <i class="bi bi-minecart-loaded"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
            </div>
          </div>
        </div>
        <div class="card shadow border-0 mb-7" style="padding: 20px">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">QUẢN LÝ ĐƠN HÀNG</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-nowrap">
              <thead class="thead-light">
                  <tr>
                      <th scope="col">Số Thứ Tự</th>
                      <th scope="col">Tên Khách Hàng</th>
                      <th scope="col">Tên Sản Phẩm</th>
                      <th scope="col">Số Lượng</th>
                      <th scope="col">Đơn Giá</th>
                      <th scope="col">Địa Chỉ</th>
                      <th scope="col">Số Điện Thoại</th>
                      <th scrop="col">Ghi chú</th>
                      <th scope="col">Trạng Thái</th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              
                <tbody>
                  <tr>
                    <?php
                      // Lấy danh sách Sản Phẩm
                      if (!isset($_GET['page'])) {
                          $pg = 1;
                          echo 'Bạn đang ở trang: 1';
                      } else {
                          $pg = $_GET['page'];
                          echo 'Bạn đang ở trang: ' . $pg;
                      }

                      try {

                          if (isset($_GET['page'])) {
                              $page = $_GET['page'];
                          } else {
                              $page = 1;
                          }
                          $limit = 10;
                          $start = ($page - 1) * $limit;
                          $sql = "SELECT * from orders, order_details, product
                          where order_details.order_id=orders.id and product.id=order_details.product_id ORDER BY order_date DESC limit $start,$limit ";
                          $order_details_List = executeResult($sql);
                          $total = 0;
                          $index = 0;
                          foreach ($order_details_List as $item) {
                            echo '  <tr>
                                        <td>' . (++$index) . '</td>
                                        <td class="text-heading font-semibold">' . $item['fullname'] . '</td>
                                        <td class="text-heading font-semibold">' . $item['title'] . '</td>
                                        <td class="text-heading font-semibold">' . $item['num'] . '</td>
                                        <td class="text-heading font-semibold">' . number_format($item['price'], 0, ',', '.') . ' VNĐ</td>
                                        <td class="text-heading font-semibold">' . $item['address'] . '</td>
                                        <td class="text-heading font-semibold">' . $item['phone_number'] . '</td>
                                        <td class="text-heading font-semibold">' . $item['note'] . '</td>
                                        <td class="text-heading font-semibold">' . $item['status'] . '</td>
                                        <td>';
                            $status = trim($item['status']);
                            // Chỉ hiển thị nút "Sửa" nếu trạng thái không phải "Hủy" hoặc "Đã nhận hàng"
                            if ($status !== 'Đã hủy' && $status !== 'Đã nhận hàng') {
                                echo '<a href="edit.php?order_id=' . $item['order_id'] . '">
                                          <button class="btn btn-success">Cập nhật</button> 
                                      </a>';
                            }else if ($status == 'Đã hủy') {
                              echo '<button class="btn btn-danger" onclick="deleteOrder(' . $item['order_id'] . ')">Xoá</button>';
                            }
                            echo '    </td>
                                    </tr>';
                        }
                      } catch (Exception $e) {
                        die("Lỗi thực thi sql: " . $e->getMessage());
                      }
                    ?>
                    
                  </tr>
                  
                </tbody>
            </table>
          </div>
          <div class="card-footer border-0 py-5">
              
            <nav aria-label="Page navigation example">
              <ul class="pagination">
              <?php
                $sql = "SELECT * FROM `product`";
                $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)) {
                  $numrow = mysqli_num_rows($result);
                  $current_page = ceil($numrow / 5);
                  
                }
                for ($i = 1; $i <= $current_page; $i++) {
                  // Nếu là trang hiện tại thì hiển thị thẻ span
                  // ngược lại hiển thị thẻ a
                  if ($i == $current_page) {
                      echo '
                            <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                  } else {
                        echo '
                            <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>
                        ';
                  }
                }
            ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<script type="text/javascript">
        function deleteOrder(id) {
            var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
            if (!option) {
                return;
            }
            console.log(id)
            //ajax - lệnh post
            $.post('delete_order.php', {
                'id': id,
                'action': 'delete'
            }, function(data) {
                location.reload()
            })
        }
</script>
</body>
</html>
