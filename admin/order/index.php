<?php
    $title = 'Quản lý đơn hàng';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');

    $sql = "SELECT * FROM orders order by status asc, order_date desc";
    $data = executeResult($sql);
?>

<!-- navbar -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Quản lý đơn hàng</h2>
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

    <!-- page content -->
    <div class="container-fluid" style="padding: 20px 40px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div class="card-header bg-white">
                    <h3 class="fs-4 mb-0 text-center">Quản lý đơn hàng</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ & Tên</th>
                                    <th>SĐT</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Nội dung</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $index = 0;
                                    foreach ($data as $item) {
                                        echo '<tr>
                                                <td>'.(++$index).'</td>
                                                <td><a href="detail.php?id='.$item['id'].'" class="text-decoration-none">'.$item['fullname'].'</a></td>
                                                <td>'.$item['phone_number'].'</td>
                                                <td>'.$item['email'].'</td>
                                                <td>'.$item['address'].'</td>
                                                <td>'.$item['note'].'</td>
                                                <td>'.number_format($item['total_money']).' VND</td>
                                                <td>'.$item['order_date'].'</td>
                                                <td>';
                                        if($item['status'] == 0) {
                                            echo '<button onclick="changeStatus('.$item['id'].', 1)" class="btn btn-sm btn-success w-100 mb-2">Approve</button>
                                                  <button onclick="changeStatus('.$item['id'].', 2)" class="btn btn-sm btn-danger w-100">Cancel</button>';
                                        } else if($item['status'] == 1) {
                                            echo '<span class="badge bg-success" style="padding: 8px 12px;">Approved</span>';
                                        } else {
                                            echo '<span class="badge bg-danger" style="padding: 8px 12px;">Canceled</span>';
                                        }
                                        echo '</td>
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper")
    var toggleButton = document.getElementById("menu-toggle")

    toggleButton.onclick = function () {
        el.classList.toggle("toggled")
    }

    function changeStatus(id, status) {
        $.post('form_api.php', {
            'id': id,
            'status': status,
            'action': 'update_status'
        }, function(data) {
            location.reload()
        })
    }
</script>