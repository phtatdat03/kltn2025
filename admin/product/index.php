<?php
    $title = 'Quản lý sản phẩm';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');

    $sql = "SELECT product.*, category.name as category_name FROM product left join category on product.category_id = category.id WHERE product.deleted = 0";
    $data = executeResult($sql, false);
?>

<div id="page-content-wrapper">
        <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Quản lý sản phẩm</h2>
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
            <div class="container-fluid px-4">
                    <div class="row-my-4">
                        <div class="col">
                            <h3 class="fs-4 mb-3">Quản lý sản phẩm</h3>
                            <a href="insert_update.php"><button class="btn btn-primary mb-3">Thêm sản phẩm</button></a>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Danh mục</th>
                                            <th style="width: 50px"></th>
                                            <th style="width: 50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $index = 0;
                                        foreach ($data as $item) {
                                            echo '<tr>
                                                    <td>' . (++$index) . '</td>
                                                    <td><img src="'.fixUrl($item['picture']).'" style="height:100px"/></td>
                                                    <td>' . $item['title'] . '</td>
                                                    <td>' .number_format($item['price']) . ' VNĐ</td>
                                                    <td>' . $item['category_name'] . '</td>
                                                    <td style="width: 50px">
                                                        <a href="insert_update.php?id=' . $item['id'] . '">
                                                            <button class="btn btn-warning">Sửa</button>
                                                        </a>
                                                    </td>
                                                    <td style="width: 50px">
                                                        <button onclick="deleteProduct('.$item['id'].')" class="btn btn-danger">Xóa</button>
                                                    </td>
                                                </tr>';
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- page content -->
    </div>

<script type="text/javascript">
    function deleteProduct(id) { 
        option = confirm('Xác nhận xóa sản phẩm?') 
        if (!option) return; 
        $.post('form_api.php', { // gửi request = AJAX(JQuery) 
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
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