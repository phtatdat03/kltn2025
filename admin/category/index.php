<?php
    $title = 'Quản lý danh mục sản phẩm';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');
    require_once('form_save.php');
    $id = $name = '';
    if (isset($_GET['id'])) {
        $id = getGet('id');
        $sql = "SELECT * FROM category WHERE id = $id";
        $data = executeResult($sql, true);
        
        if ($data != null) {
            $name = $data['name'];
        }
    }
    
    $sql = "SELECT * FROM category";
    $data = executeResult($sql);
?>
        <div id="page-content-wrapper">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Quản lý danh mục sản phẩm</h2>
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
            <!-- end navbar -->

            <!-- page content -->
            <div class="container-fluid px-4" style="padding: 20px;">
                <div class="row my-4" style="display: flex; gap: 20px;">
                    <!-- Bảng hiển thị danh mục-->
                    <div class="col-md-8" style="flex:2;">
                        <h3 class="fs-4 mb-3" style="margin-bottom: 20px;">Quản lý danh mục sản phẩm</h3>
                        <div class="table-responsive" style="border: 1px solid #ddd; border-radius: 8px; padding: 10px;">
                            <table class="table table-striped table-bordered" style="width: 100%; text-align: center;">
                                <thead>
                                    <tr style="background-color: #f8f9fa;">
                                        <th style="padding: 10px;">STT</th>
                                        <th style="padding: 10px;">Tên danh mục</th>
                                        <th style="width: 50px; padding: 10px"></th>
                                        <th style="width: 50px; padding: 10px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $index = 0;
                                        foreach ($data as $item) {
                                            echo '<tr>
                                                    <td style="padding: 10px;">'.(++$index).'</td>
                                                    <td style="padding: 10px;">'.$item['name'].'</td>
                                                    <td style="padding: 10px; width: 50px">
                                                        <a href="?id='.$item['id'].'">
                                                        <button class="btn btn-warning style="width: 100%; background-color: #ffc107;
                                                        color: #fff; border: none; border-radius: 5px;">Sửa</button>
                                                        </a>
                                                    </td>
                                                    <td style="padding: 10px; width: 50px">
                                                        <button onclick="deleteCategory('.$item['id'].')" class="btn btn-danger style="width: 100%; background-color: #dc3545; color: #fff; border: none; border-radius: 5px;">Xóa</button>
                                                    </td>
                                                </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Form nhập danh mục-->
                    <div class="col-md-4" style="flex: 1;">
                        <h3 class="fs-4 mb-3" style="margin-bottom: 20px;">Tên danh mục sản phẩm</h3>
                        <form method="POST" action="index.php" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="categoryName" value="<?=$name?>" name="name" placeholder="Nhập tên danh mục" required style="border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                <input type="text" name="id" value="<?=$id?>" hidden="true">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" style="background-color: #007bff; border: none; padding: 10px; border-radius: 5px;">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- page content -->
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Hàm xóa danh mục -->
<script type="text/javascript">
    function deleteCategory(id) { // truyền vào id danh mục
        option = confirm('Xác nhận xóa danh mục?')
        if (!option) return; 
        $.post('form_api.php', { // gửi request = AJAX(JQuery) 
            'id': id,
            'action': 'delete'
        }, function(data) {
            if(data != null && data != '' ){
                alert(data);
                return;
            }
            location.reload()
        })
    }
</script>
<script>
    var el = document.getElementById("wrapper")
    var toggleButton = document.getElementById("menu-toggle")

    toggleButton.onclick = function () {
        el.classList.toggle("toggled")
    }
</script>
</body>
</html>