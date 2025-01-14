<?php
    $title = 'Thông tin chi tiết đơn hàng';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');

    $orderId = getGet('id');

    $sql = "select order_details.*, product.title, product.picture 
            from order_details 
            left join product on product.id = order_details.product_id 
            where order_details.order_id = $orderId";
    $data = executeResult($sql);

    $sql = "select * from orders where id = $orderId";
    $orderItem = executeResult($sql, true);
?>

<div id="page-content-wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Chi tiết đơn hàng</h2>
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

    <!-- Page Content -->
    <div class="container-fluid px-4">
        <div class="row d-flex justify-content-center align-items-start">
            <!-- Bảng sản phẩm -->
            <div class="col-lg-8 mb-4">
                <h3 class="fs-4 mb-3 text-center">Chi tiết sản phẩm</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            foreach ($data as $item) {
                                echo '<tr>
                                        <td>'.(++$index).'</td>
                                        <td><img src="'.fixUrl($item['picture']).'" style="height: 100px;"></td>
                                        <td>'.$item['title'].'</td>
                                        <td>'.$item['price'].'</td>
                                        <td>'.$item['num'].'</td>
                                        <td>'.$item['total_money'].'</td>
                                      </tr>';
                            }
                            ?>
                            <tr>
                                <td colspan="4"></td>
                                <th>Tổng Tiền</th>
                                <th><?=$orderItem['total_money']?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bảng thông tin khách hàng -->
            <div class="col-lg-4">
                <h3 class="fs-4 mb-3 text-center">Thông tin khách hàng</h3>
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Họ & Tên:</th>
                        <td><?=$orderItem['fullname']?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?=$orderItem['email']?></td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ:</th>
                        <td><?=$orderItem['address']?></td>
                    </tr>
                    <tr>
                        <th>SĐT:</th>
                        <td><?=$orderItem['phone_number']?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    }
</script>
