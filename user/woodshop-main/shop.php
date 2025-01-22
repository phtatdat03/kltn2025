<?php
    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');
    $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

    // Câu lệnh truy vấn sản phẩm
    $sql = "SELECT product.*, category.name as category_name 
            FROM product 
            LEFT JOIN category ON product.category_id = category.id 
            WHERE product.deleted = 0";

    // Nếu có danh mục, thêm điều kiện lọc
    if ($categoryId && $categoryId !== 'all') {
        $sql .= " AND product.category_id = '$categoryId'";
    }

    // Lấy dữ liệu sản phẩm
    $products = executeResult($sql);

    // Phân trang
    $pageSize = 6;
    $totalProducts = count($products);
    $totalPages = ceil($totalProducts / $pageSize);

    // Lấy danh mục
    $sql1 = "SELECT * FROM category";
    $categories = executeResult($sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png"
    type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <title>Sản phẩm</title>
</head>
<body>
    <div class="container-fluid">
        <div class="header">
                <div class="top-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="header-icon">
                                    <ul class="d-flex">
                                        <li class="icon"><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="icon"><a href=""><i class="fab fa-instagram"></i></a></li>
                                        <li class="icon"><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li class="icon"><a href=""><i class="fab fa-youtube"></i></a></li>
                                        <li class="icon"><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="header-contact">
                                    <ul class="d-flex justify-content-end">
                                        <li class="contact">
                                            <a href="" class="header-shop-map">
                                                <i class="fas fa-map-marker-alt"></i>
                                                Hệ thống cửa hàng
                                            </a>
                                        </li>
                                        <li class="contact">
                                            <a href="" class="header-shop-phone">
                                                <i class="fas fa-phone"></i>
                                                (+84)934 323 882
                                            </a>
                                        </li>
                                        <li class="contact">
                                            <a href="" class="header-shop-support">
                                                <i class="fas fa-envelope"></i>
                                                support@suplo.vn
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="container">
                        <div class="row">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="container-fluid">
                                    <div class="logo">
                                        <a href="index.php">
                                            <img src="img/logo.png" alt="">
                                        </a>
                                    </div>
                                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                  </button>
                                  <div class="collapse navbar-collapse hide justify-content-center" id="navbarSupportedContent">
                                    <ul class="navbar-nav  mb-2 mb-lg-0 justify-content-center">
                                      <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active pro" aria-current="page" href="shop.php">Sản phẩm</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active newss" aria-current="page" href="allnews.html">Tin tức</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="contact.html">Liên hệ</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="about.html">Giới thiệu</a>
                                      </li>
                                    </ul>
                                  </div>
                                  <ul class="icon-nav justify-content-end d-flex">
                                    <li>
                                        <a class="icon-user" href=""  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-alt"></i></a>
                                    </li>
                                    <li>
                                        <a class="icon-buy" href="cart.html">
                                            <i class="fas fa-shopping-cart"></i>
                                            <div class="number-buy">0</div>
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="responsive-navbar text-center hide an">
                    <div class="row">
                        <div class="col-12">
                            <div class="search">
                                <input type="text" placeholder="Tìm kiếm...">
                                <i class="fas fa-search"></i>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 d-flex flex-column align-items-start res-left">
                                    <div class="res-home">
                                        <a href=""><i class="fas fa-house-user"></i>Trang chủ</a>
                                    </div>
                                    <div class="resproducts">
                                        <a href=""><i class="fas fa-cart-plus"></i>Sản phẩm</a>
                                    </div>
                                    <div class="res-contact">
                                        <a href=""><i class="fas fa-map-marker-alt"></i>Liên hệ</a>
                                    </div>
                                    <div class="res-about">
                                        <a href=""><i class="fas fa-address-card"></i>Giới thiệu</a>
                                    </div>
                                    <div class="about-us">
                                        <a href=""><i class="fab fa-themeisle"></i>Về chúng tôi</a>
                                    </div>
                                </div>
                                <div class="col-6 d-flex flex-column align-items-start res-right">
                                    <div class="love">
                                        <a href=""><i class="far fa-heart"></i>Yêu thích</a>
                                    </div>
                                    <div class="res-n">
                                        <a href=""><i class="far fa-newspaper"></i>Tin tức</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="buy-success d-flex justify-content-center align-items-center hide">
            <p>Đặt hàng thành công</p>
        </div>
        <div class="banner">
            <div class="inner">
                <div class="container text-center">
                    <p class="title-heading">SẢN PHẨM</p>
                    <p class="intro"><a href="index.php">Trang chủ</a>/ <a href="shop.html">Sản phẩm</a></p>
                </div>
            </div>
        </div>
        <div class="shop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="filter">
                            <div class="loaihang">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Loại sản phẩm
                                        </button>
                                      </h2>
                                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li class="all-sp">
                                                    <a href="?category_id=all">Tất cả</a>
                                                </li>
                                                <?php foreach ($categories as $category): ?>
                                                    <li class="check-<?= strtolower($category['name']) ?>">
                                                        <a href="?category_id=<?= $category['id'] ?>"><?= $category['name'] ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="loctheogia">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Mức giá
                                        </button>
                                      </h2>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-center">
                                            <div class="ranger-slider">
                                                <div id="slider-range"></div>
                                                <div class="price-filter d-flex align-items-center justify-content-center">
                                                    <p>Giá:</p><strong></strong> <span id="slider-range-value1"></span><span>-</span><strong></strong> <span id="slider-range-value2"></span>
                                                </div>
                                            </div>
                                            <button class="button-filter">Lọc</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="boloc d-flex">
                            <p class="giacao"><i class="fas fa-sort-amount-up"></i>Giá cao</p>
                            <p class="giathap"><i class="fas fa-sort-amount-down-alt"></i>Giá thấp</p>
                        </div>
                        <div id="product-container" class="product-page">
                            <div class="row">
                                <?php
                                for ($i = 0; $i < $totalProducts; $i++) {
                                    $product = $products[$i];
                                    ?>
                                    <div class="col-lg-4 col-md-6 nopadding product-item" data-page="<?php echo floor($i / $pageSize) + 1; ?>">
                                        <div class="product">
                                            <a href="detail.php?id=<?= $product['id'] ?>">
                                                <img src="<?php echo fixUrl($product['picture']); ?>" alt="<?php echo $product['title']; ?>" class="product-img">
                                                <div class="product-info">
                                                    <p class="name-product text-center"><?php echo $product['title']; ?></p>
                                                    <div class="price-product text-center">
                                                        <p class="price"><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</p>
                                                    </div>
                                                    <div class="buttons d-flex">
                                                        <button class="addCart" onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo $product['title']; ?>', 1, <?php echo $product['price']; ?>, '<?php echo $product['picture']; ?>')">
                                                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                                        </button>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="pagination" class="pagination justify-content-center d-flex"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-login">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Đăng nhập</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Đăng kí</button>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <div class="modal-inner">
                                      <input type="text" class="user-name" placeholder="Tài khoản">
                                      <p class="wrong-user is-invalid">Tài khoản phải có độ dài 6-12 kí tự và không chứa kí tự đặc biệt</p>
                                      <input type="text" class="pass" placeholder="Mật khẩu">
                                      <p class="wrong-pass is-invalid">Mật khẩu phải có độ dài 6-12 kí tự.</p>
                                      <button class="login">Đăng nhập</button>
                                      <div class="row">
                                          <div class="col-6 save">
                                              <input type="checkbox">Lưu mật khẩu
                                          </div>
                                          <div class="col-6 forget text-end">
                                              <a href="">Quên mật khẩu</a>
                                          </div>
                                      </div>
                                      <p class="text-center">Hoặc</p>
                                      <div class="oline d-flex justify-content-center">
                                          <a href="">
                                              <img src="img/facebook.png" alt="">
                                          </a>
                                          <a href="">
                                              <img src="img/google.png" alt="">
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                              <div class="modal-inner">
                                <div class="regis">
                                    <input type="text" class="user-name" placeholder="Tài khoản">
                                    <p class="wrong-user is-invalid">Tài khoản phải có độ dài 6-12 kí tự và không chứa kí tự đặc biệt</p>
                                    <input type="text" class="pass" placeholder="Mật khẩu">
                                    <p class="wrong-pass is-invalid">Mật khẩu phải có độ dài 6-12 kí tự.</p>
                                    <input type="text" class="again" placeholder="Nhập lại mật khẩu">
                                    <p class="wrong-again is-invalid">Mật khẩu phải có độ dài 6-12 kí tự.</p>
                                    <button class="register-button">Đăng kí</button>
                                </div>
                              </div>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="footer">
            <div class="footer-inner">
              <div class="container">
                <div class="row">
                  <div class="col-lg-3 col-sm-12">
                    <img src="img/logo.png" alt="" class="footer-img">
                    <div class="address">
                      <i class="fas fa-home"></i>
                      Số 1 Lương Yên, Q.Hai Bà Trưng, Hà Nội
                    </div>
                    <div class="phone-footer">
                      <i class="fas fa-phone"></i>
                      (+84)934 323 882
                    </div>
                    <div class="supports">
                     <i class="far fa-envelope"></i>
                      support@suplo.vn
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 cot2">
                    <h4 class="title-col2">DỊCH VỤ KHÁCH HÀNG</h4>
                    <p><a href="">Hướng dẫn đặt mua hàng</a></p>
                    <p><a href="">Kinh nghiệm mua hàng</a></p>
                    <p><a href="">Đối tác và đại lý</a></p>
                    <p><a href="">Hình thức thanh toán</a></p>
                    <p><a href="">Mua hàng và đổi trả</a></p>
                  </div>
                  <div class="col-lg-3 col-sm-12 cot3">
                    <h4 class="title-col3">HỖ TRỢ</h4>
                    <p><a href="">Đổi trả</a></p>
                    <p><a href="">Chính sách bảo hành</a></p>
                    <p><a href="">Chính sách vận chuyển</a></p>
                    <p><a href="">Điều khoản dịch vụ</a></p>
                    <p><a href="">Chính sách quyền riêng tư</a></p>
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <h4 class="title-col4">LIKE SUPLO TRÊN MẠNG XÃ HỘI</h4>
                    <div class="col4-item">
                      <a href=""><i class="fab fa-facebook-f"></i></a>
                      <a href=""><i class="fab fa-instagram"></i></a>
                      <a href=""><i class="fab fa-youtube"></i></a>
                      <a href=""><i class="fab fa-twitter"></i></a>
                      <a href=""><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <h4 class="title-col4">ĐĂNG KÝ NHẬN TIN</h4>
                    <div class="col4-input d-flex">
                      <input placeholder="Nhập email của bạn..." type="text">
                      <button><a href=""><i class="fab fa-telegram-plane"></i></a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="footer-madeby text-center">
              <p>Made by © 2023</p>
            </div>
          </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="js/addcart.js"></script> -->
    <script src="js/addcart.js"></script>
    <script src="js/shop.js"></script>
    <script src="js/validation.js"></script>
    <script>
        // JavaScript để thực hiện phân trang động
        const pageSize = <?php echo $pageSize; ?>;
        const totalProducts = <?php echo $totalProducts; ?>;
        const totalPages = <?php echo $totalPages; ?>;
        const productItems = document.querySelectorAll('.product-item');
        const paginationContainer = document.getElementById('pagination');

        function renderPagination() {
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = 'btn btn-number';
                pageButton.innerText = i;
                pageButton.setAttribute('data-page', i);
                pageButton.onclick = () => showPage(i);
                paginationContainer.appendChild(pageButton);
            }
        }

        function showPage(page) {
            productItems.forEach(item => {
                item.style.display = item.getAttribute('data-page') == page ? 'block' : 'none';
            });
            // Đánh dấu trang hiện tại
            document.querySelectorAll('.btn-number').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.btn-number[data-page="${page}"]`).classList.add('active');
        }

        // Khởi tạo giao diện phân trang
        renderPagination();
        showPage(1);
        document.querySelectorAll('input[name="category"]').forEach(input => {
            input.addEventListener('change', () => {
                const selectedCategories = Array.from(
                    document.querySelectorAll('input[name="category"]:checked')
                ).map(input => input.value);

                if (selectedCategories.includes('all')) {
                    renderProducts(products); // Hiển thị tất cả sản phẩm
                } else {
                    const filteredProducts = products.filter(product =>
                        selectedCategories.includes(product.category_id.toString())
                    );
                    renderProducts(filteredProducts); // Hiển thị sản phẩm lọc
                }
            });
        });

    </script>
</body>
</html>