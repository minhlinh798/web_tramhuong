<?php
    include "connect.php";
    $sql = "SELECT * FROM danhmuc";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm Trầm Hương</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="./page.css">
    <link rel="stylesheet" href="../../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap v5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
     <!-- Header -->
     <header>
        <div class="header-top">
            <div class="left">
                <p>Sản phẩm Trầm hương và trang sức Trầm hương</p>
            </div>
            <div class="right">
                <ul>
                    <li><a href="mailto:linhclear@gmail.com"><i class="bi bi-envelope"></i> linhclear@gmail.com</a></li>
                    <li><a href="tel:0337 263 708"><i class="bi bi-telephone"></i> 0337 263 708</a></li>
                    <li><a href=""><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="header-bottom">
            <div class="logo">
                <a href="index.php">
                    <img src="../../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav class="header-line">
                <ul>
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="../blog.php">Giới thiệu</a></li>
                    <li><a href="../product.php">Sản Phẩm Trầm Hương</a></li>
                    <li><a href="../news.php">Tin tức</a></li>
                    <li><a href="../contact.php">Liên hệ</a></li>
                </ul>
            </nav>
            <div class="search">
                <input placeholder="Tìm kiếm sản phẩm" type="text">
                <button class="btn-search"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <div class="main-hey">
            <div class="main-list">
                <h1>Nhang, Nụ Trầm Hương</h1>
            </div>
        </div>
        <div class="group-list">
            <ul class="list-group">
                <?php
                    while ($row = mysqli_fetch_assoc($result)) { 
                ?>
                    <li class="list-group-item">
                        <a href="<?php echo $row['slug']; ?>.php">
                            <?php echo $row['ten_danhmuc']; ?>
                        </a>
                    </li>
                <?php
                    } 
                ?>
            </ul>
            <div class="conmemner">
                <div class="product">
                    <div class="product-top">
                        <div class="rowmen">
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i9.png" class="card-img-top" alt="Bột trầm nguyên chất kiến kim tự nhiên (LOẠI CAO CẤP)">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Bột trầm nguyên chất kiến kim tự nhiên (LOẠI CAO CẤP)</a></h5>
                                  <p class="card-text">Giá: 500,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i10.png" class="card-img-top" alt="Nụ trầm hương nguyên chất- Trầm hương Quảng Nam">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Nụ trầm hương nguyên chất- Trầm hương Quảng Nam</a></h5>
                                  <p class="card-text">Giá: 220,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i11.png" class="card-img-top" alt="Nụ trầm hương thiên nhiên nguyên chất sạch">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Nụ trầm hương thiên nhiên nguyên chất sạch</a></h5>
                                  <p class="card-text">Giá: 500,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i12.png" class="card-img-top" alt="Nhang Trầm kiến thiên nhiên nguyên chất ( Dòng Cao Cấp)">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Nhang Trầm kiến thiên nhiên nguyên chất ( Dòng Cao Cấp)</a></h5>
                                  <p class="card-text">Giá: 1,000,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i13.png" class="card-img-top" alt="Bột Trầm Hương Nguyên Chất( Loại phổ thông)">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Bột Trầm Hương Nguyên Chất( Loại phổ thông)</a></h5>
                                  <p class="card-text">Giá: 300,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i14.png" class="card-img-top" alt="Nhang có tăm- nhang trầm hương thiên nhiên sạch">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Nhang có tăm- nhang trầm hương thiên nhiên sạch</a></h5>
                                  <p class="card-text">Giá: 500,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i15.png" class="card-img-top" alt="Nụ trầm Kiến kim rừng tự nhiên loại đặt biệt">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Nụ trầm Kiến kim rừng tự nhiên loại đặt biệt</a></h5>
                                  <p class="card-text">Giá: 1,200,000 VNĐ</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="../../assets/images/i16.png" class="card-img-top" alt="Bột trầm nguyên chất kiến kim tự nhiên (LOẠI ĐẶT BIỆT)">
                                <div class="card-body">
                                  <h5 class="card-title"><a href="">Bột trầm nguyên chất kiến kim tự nhiên (LOẠI ĐẶT BIỆT)</a></h5>
                                  <p class="card-text">Giá: 1,200,000 VNĐ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                      <li class="page-item"><a class="page-link" href="../category/product3.php">1</a></li>
                      <li class="page-item"><a class="page-link" href="./page3.php">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">Kế Tiếp</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="../../assets/images/logo.png">
                        <p>
                            Hiện nay, Trầm Hương Tiên Phước không ngừng<br>
                            cung cấp và cập nhật thêm các sản phẩm giá trị,<br>
                            đồng thời liên tục hoàn thiện chất lượng dịch vụ<br>
                            để hướng tới tầm nhìn trở thành Trung tâm phân<br>
                            phối nhụy hoa nghệ tây - lớn nhất Đông Nam Á.
                        </p>
                    </div>
                    <div class="col order-5">
                        <h3>Theo Dõi Chúng Tôi</h3>
                        <p><a href=""><i class="bi bi-facebook"></i> Facebook</a></p>
                        <p><a href=""><i class="bi bi-youtube"></i> Youtube</a></p>
                        <p><a href=""><i class="bi bi-tiktok"></i>  Tiktok</a></p>
                        <p><a href=""><i class="bi bi-instagram"></i> Instagram</a></p>
                        <p><a href=""><i class="bi bi-telegram"></i> Telegram</a></p>
                    </div>
                    <div class="col order-1">
                        <h3>Hỗ Trợ Khách Hàng</h3>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách mua hàng</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách thanh toán</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách bảo mật thông tin</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách vận chuyển</a></p>
                        <p><a href=""><i class="icofont-hand-right"></i> Chính sách bảo hành</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            @ 2025 <span>Trầm Hương Tiên Phước - Uy Tín - Chất Lượng</span> - Tạo Nên Thương Hiệu
        </div>
    </footer>
    <!-- JavaScript -->
    <script src="../../assets/js/javascript.js"></script>
</body>
</html>