
<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
// Lấy id từ trang index.php truyền sang rồi hiển thị nó
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select product.*, collections.name as collection_name from product, collections where product.id_sanpham = collections.id and product.id=' . $id;
    $product = executeSingleResult($sql);
    // Kiểm tra nếu ko có id sp đó thì trả về index.php
    if ($product == null) {
        header('Location: index.php');
        die();
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
          <h2 class="page-title">CỬA HÀNG</h2>
          <p><a href="#">Trang chủ</a> | Cửa hàng</p>
        </div>
      </div>
    </div>
  </div>
</section>
<main>
  <div class="container">
    <!-- END LAYOUT  -->
    <section class="main">
      <section class="oder-product" >
        <div class="title">
          <section class="main-order">
            <div class="box">
              <div class="left" >
                <h1><?= $product['title'] ?></h1>
                <li >
                  <div class="main_image" >
                    <img src="<?='admin/product/'.$product['thumbnail'] ?>" alt="">
                  </div>
                  <div class="main_image">
                    <img src="<?='admin/product/'.$product['thumbnail_1'] ?>" alt="">
                  </div>
                  <div class="main_image">
                    <img src="<?='admin/product/'.$product['thumbnail_2'] ?>" alt="">
                  </div>
                </li>

                <li>
                  <div class="main_image">
                    <img src="<?='admin/product/'.$product['thumbnail_3'] ?>" alt="">
                  </div>
                  <div class="main_image">
                    <img src="<?='admin/product/'.$product['thumbnail_4'] ?>" alt="">
                  </div>
                  <div class="main_image">
                    <img src="<?='admin/product/'.$product['thumbnail_5'] ?>" alt="">
                  </div>
                </li>

            </div>
            <div class="about">
              <!-- style="padding-top:105px;margin-left:10px; width:300px -->
                <p ><?= $product['content'] ?></p>
                <!-- style="padding-top:20px;margin-left:10px; width:300px" p-->
                 <!-- style="font-weight: 600; color:#FF6600 span" -->
                <p style="padding-top:20px;margin-left:10px; width:300px">Thương Hiệu: <span style="font-weight: 600; color:#FF6600 span"><?= $product['collection_name'] ?></span></p>
                
                <script>
                // Add active class to the current button (highlight it)
                var header = document.getElementById("myDIV");
                var btns = header.getElementsByClassName("btn");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                    });
                }
                </script> 
                
                <!-- style="padding-top:10px;margin-left:10px;" -->
                <div class="number">
                  <span class="number-buy" style="padding-top:10px;margin-left:10px;">Số lượng</span>
                  <input id="num" type="number" value="1" min="1" onchange="updatePrice()">
                </div>
                
                <!-- style="padding-top:70px;margin-left:10px;" -->
                <p class="price" style="padding-top:70px;margin-left:10px;">Giá: <span id="price"><?= number_format($product['price'], 0, ',', '.') ?></span><span> VNĐ</span><span class="gia none"><?= $product['price'] ?></span></p>
                <?php 
                // style="margin-left:10px; css button"
                // style="margin-left:10px; css button"
                  if(isset($_COOKIE['username'])){
                      echo '<button class="add-cart"  style="margin-top:10px; onclick="addToCart(' . $id . ')"><i class="fas fa-cart-plus"></i><a href="/cart.php"></a> Thêm vào giỏ hàng</button>
                      <p></p>
                      <br>
                      <button class="buy-now"  onclick="buyNow(' . $id . ')"><i class="fas fa-money-check"></i> Mua ngay</button>';
                  } else {
                    echo '<div class="wc-proceed-to-checkout" style="text-align: center;">
                    <p class="return-to-shop">
                      <a class="button wc-backward" href="login.php">Đăng nhập để thêm giỏ hàng</a>
                    </p>
                    </div>';
                  }
                ?>
                

                <script>
                  function updatePrice() {
                    var price = document.getElementById('price').innerText; // giá tiền
                    var num = document.querySelector('#num').value; // số lượng
                    var gia1 = document.querySelector('.gia').innerText;
                    var gia = price.match(/\d/g);
                    gia = gia.join("");
                    var tong = gia1 * num;
                    document.getElementById('price').innerHTML = tong.toLocaleString();
                  }
                </script>
                <script type="text/javascript">
                  function addToCart(id) {
                    var num = document.querySelector('#num').value; // số lượng
                    $.post('api/cookie.php', {
                      'action': 'add',
                      'id': id,
                      'num': num
                    }, function(data) {
                      location.reload()
                    })
                  }

                  function buyNow(id) {
                    $.post('api/cookie.php', {
                      'action': 'add',
                      'id': id,
                      'num': 1
                    }, function(data) {
                      location.assign("checkout_product.php");
                    })
                  }
                </script>
            </div>
            <div class="fb-comments" data-href="http://localhost/PROJECT/details.php" data-width="750" data-numposts="5"></div>

          </section>
        </div>
      </section>
      <section class="restaurants">
          <div class="title">
              <h1>Các sản phẩm khác tại <span class="green" style="color: #0099FF;">LUXURY HOME</span></h1>
          </div>
          <div class="product-restaurants">
              <div class="row">
                  <?php
                  $sql = 'select * from product where number > 0';
                  $productList = executeResult($sql);
                  $index = 1;
                  foreach ($productList as $item) {
                      echo '
                          <div class="col">
                              <a href="single_product.php?id=' . $item['id'] . '">
                                  <img class="thumbnail" src="admin/product/' . $item['thumbnail'] . '" alt="">
                                  <div class="title">
                                      <p>' . $item['title'] . '</p>
                                  </div>
                                  <div class="price">
                                      <span>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</span>
                                  </div>
                              </a>
                          </div>
                          ';
                  }
                  ?>
              </div>
          </div>
      </section>
    </section>
  </div>
</main>

<style>
.about {
  font-family: 'Roboto', sans-serif;
  background: #f9f9f9;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 80%;
  /* Màu chữ tổng thể cho phần thông tin */
  color: #4a4a4a; /* Xám đậm, dễ đọc */
}

.about p {
  margin: 0;
  font-size: 1rem;
  line-height: 1.5;
  color: #4a4a4a;
}

/* Phần số lượng */
.about .number {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #4a4a4a;
}

/* Giá sản phẩm: dùng tone ấm, nổi bật nhưng không quá chói */
.about .price {
  font-size: 1.5rem;
  font-weight: bold;
  color: #c87d4b; /* tone nâu cam ấm áp */
}

/* Các nút hành động */
.about button {
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-transform: uppercase;
  font-weight: bold;
}

/* Nút thêm vào giỏ hàng */
.add-cart {
  background: #c87d4b;
  color: #fff;
}

.add-cart:hover {
  background: #b0663e;
}

/* Nút mua ngay */
.buy-now {
  background: #5a8f7b; /* tone xanh đậm, sang trọng */
  color: #fff;
}

.buy-now:hover {
  background: #507d68;
}

/* Đặt container chứa hình ảnh ở trạng thái relative để các phần tử con định vị theo nó */
.left {
  position: relative;
  padding-top: 60px;
  width: 80%;
  padding-right: 30px;
}

/* Định dạng tiêu đề sản phẩm để overlay trên hình ảnh */
.left h1 {
  position: absolute;
  top: 10px; /* khoảng cách từ trên cùng của container */
  left: 10px; khoảng cách từ bên trái
  background-color: rgba(255, 255, 255, 0.8); /* nền bán trong suốt giúp tên dễ đọc */
  padding: 10px 15px;
  font-size: 1.8rem;
  color: #4a4a4a;
  border-radius: 4px;
  z-index: 2; /* đảm bảo tiêu đề hiển thị trên cùng các phần tử khác */
}


</style>

<?php require_once('Layout/footer.php'); ?>