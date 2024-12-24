<?php
    $title = 'Quản lý phản hồi';
    $baseUrl = '../';
    require_once('../layouts/side_bar.php');

    $sql = "SELECT * FROM feedback order by status asc, updated_at desc"; //ưu tiên những cái chưa đọc đẩy lên trên, còn nếu cùng 1 giá trị thì cái nào tạo sau sẽ đẩy lên trc

    $data = executeResult($sql);
?>

        <!-- page content -->
        <div id="page-content-wrapper">
        <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Quản lý phản hồi</h2>
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
                            <h3 class="fs-4 mb-3">Quản lý phản hồi</h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ</th>
                                            <th>Tên</th>
                                            <th>SĐT</th>
                                            <th>Email</th>
                                            <th>Chủ đề</th>
                                            <th>Nội dung</th>
                                            <th>Ngày tạo</th>
                                            <th style="width: 50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $index = 0;
                                        foreach ($data as $item) {
                                            echo '<tr>
                                                    <td>' . (++$index) . '</td>
                                                    <td>' . $item['firstname'] . '</td>
                                                    <td>' . $item['lastname'] . '</td>
                                                    <td>' . $item['phone_number'] . '</td>
                                                    <td>' . $item['email'] . '</td>
                                                    <td>' . $item['subject_name'] . '</td>
                                                    <td>' . $item['note'] . '</td>
                                                    <td>' . $item['updated_at'] . '</td>
                                                    <td style="width: 120px">';
                                            if($item['status'] == 0) {
                                                echo '<button onclick="read('.$item['id'].')" class="btn btn-danger">Đã đọc</button>';
                                            }    
                                            echo        '</td>
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
    function read(id) { // truyền vào id của tài khoản cần xóa
        $.post('form_api.php', { // gửi request = AJAX(JQuery) 
            'id': id,
            'action': 'mark'
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