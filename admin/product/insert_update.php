<?php
    $title = 'Form thêm/sửa sản phẩm';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');
    $id = $picture = $title = $price = $discount = $category_id = $description ='';
    require_once('form_save.php');

    //lấy id sản phẩm để lấy thông tin của sản phẩm, nếu mã tồn tại fill vào form chỉnh sửa
    $id = getGet('id');
    if($id != '' && $id > 0) {
        $sql = "SELECT * FROM product WHERE id = '$id' and deleted=0";
        $categoryItem = executeResult($sql, true);
        if($categoryItem != null) {
            $picture = $categoryItem['picture'];
            $title = $categoryItem['title'];
            $price = $categoryItem['price'];
            $discount = $categoryItem['discount'];
            $category_id = $categoryItem['category_id'];
            $description = $categoryItem['description'];
        } else {
            $id = 0; //trường hợp k tìm thấy id thì sẽ xóa id
        }
    } else {$id = 0;}

    $sql = "SELECT * FROM category";
    $categoryItems = executeResult($sql); // chứa danh sách các quyền trong hệ thống

?>
        
        <div id="page-content-wrapper">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Thêm/Sửa sản phẩm</h2>
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
                    <form method="POST">
                        <!-- tên sp -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sản phẩm" value="<?=$title?>" required>
                        </div>
                        <input type="text" name="id" value="<?=$id?>" hidden="true">
                        <!-- chọn danh mục -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Danh mục sản phẩm:</label>
                            <select class="form-control" name="category_id" id="category_id" required="true">
                                <option value="">-- Chọn --</option>
                                <?php
                                    foreach ($categoryItems as $category) {
                                        if($category['id'] == $category_id) {
                                            echo '<option selected value="'.$category['id'].'">'.$category['name'].'</option>'; 
                                        } else {
                                            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>'; 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- ảnh -->
                        <div class="mb-3">
                            <label for="picture" class="form-label">Ảnh:</label>
                            <input type="text" class="form-control" id="picture" name="picture" value="<?=$picture?>" >
                        </div>

                        <!-- giá -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá" value="<?=$price?>" required>
                        </div>

                        <!-- giảm giá -->
                        <div class="mb-3">
                            <label for="discount" class="form-label">Giảm giá</label>
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Nhập giá discount" value="<?=$discount?>" required>
                        </div>

                        <!-- mô tả -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả:</label>
                            <textarea class="form-control" row="5" name="description" id="description" placeholder="Nhập mô tả" required><?=$description?></textarea>
                        </div>

                        <!-- Nút đăng ký -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
            </div>
            <!-- page content -->
        </div>

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