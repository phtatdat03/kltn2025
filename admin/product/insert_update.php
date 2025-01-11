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
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Cột 1 -->
                        <div class="col-md-6">
                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sản phẩm" value="<?=$title?>" required>
                            </div>

                            <!-- Mô tả -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả:</label>
                                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Nhập mô tả" required><?=$description?></textarea>
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6">
                            <!-- Ảnh -->
                            <div class="mb-3">
                                <label for="picture" class="form-label">Ảnh:</label>
                                <input type="file" class="form-control" id="picture" name="picture" 
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <img id="picture_img" src="<?=$picture?>" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px">
                            </div>

                            <!-- Chọn danh mục -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Danh mục sản phẩm:</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="">-- Chọn --</option>
                                    <?php
                                    foreach ($categoryItems as $category) {
                                        if ($category['id'] == $category_id) {
                                            echo '<option selected value="'.$category['id'].'">'.$category['name'].'</option>'; 
                                        } else {
                                            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>'; 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Giá -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá" value="<?=$price?>" required>
                            </div>

                            <!-- Giảm giá -->
                            <div class="mb-3">
                                <label for="discount" class="form-label">Giảm giá</label>
                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Nhập giá discount" value="<?=$discount?>" required>
                            </div> 

                            <!-- Nút Lưu -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-auto">Lưu sản phẩm</button>
                            </div>
                        </div>
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

<script type="text/javascript">
    function updatePicture() {
        $('#picture_img').attr('src', $('#picture').val())
    }
</script>

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 200, 
            placeholder: 'Nhập mô tả sản phẩm...',
            tabsize: 2
        });
    });
</script>

</body>
</html>