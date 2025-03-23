<?php
    session_start();
    include "../modules/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tin Tức</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/news.css">
    <link rel="stylesheet" href="../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/bootstrap v5/css/bootstrap.min.css">
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
                    <li><a href="./carts.php"><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li>
                </ul>
            </div>
            <div class="btn-login">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <!-- Nếu chưa đăng nhập, hiển thị nút Login -->
                    <button class="btn">
                        <a href="./login.php">Login</a>
                    </button>
                <?php } else { ?>
                    <!-- Nếu đã đăng nhập, hiển thị icon hồ sơ -->
                    <div class="profile-container">
                        <img src="../assets/images/icons.png" width="40px" id="profile-icon">
                        <div class="dropdown-menu" id="profile-menu">
                            <a class="dropdown-item" href="#">Hồ Sơ</a>
                            <a class="dropdown-item" href="#">Cài Đặt</a>
                            <a class="dropdown-item" href="lsmuahang.php">Lịch Sử Mua Hàng</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php">Đăng Xuất</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="header-bottom">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="blog.php">Giới thiệu</a></li>
                    <li><a href="product.php">Sản Phẩm Trầm Hương</a></li>
                    <li><a href="news.php">Tin tức</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </nav>
            <div class="search">
                <form action="search.php" method="GET">
                    <input name="keyword" placeholder="Tìm kiếm sản phẩm" type="text" required>
                    <button type="submit" class="btn-search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <style>
            .btn-login button {
                background-color: #007bff;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                color: white;
                transition: 0.3s ease-in-out;
            }
            .btn-login button:hover {
                background-color: #0056b3;
            }
            .btn-login a {
                text-decoration: none;
                color: white;
            }
            .right {
                padding-left: 225px;
            }
            .profile-container {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }
            .profile-container img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                cursor: pointer;
            }
            #profile-menu {
                display: none;
                position: absolute;
                right: -50px;
                background: white;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 150px;
                padding: 10px;
            }
            #profile-menu a {
                display: block;
                padding: 8px;
                text-decoration: none;
                color: black;
            }
            #profile-menu a:hover {
                background: #f0f0f0;
            }
            .container {
                max-width: 1200px;
                margin: auto;
                padding: 35px;
            }
        </style>
        <div class="container">
            <header class="top">
                <h1>Tin Tức</h1>
            </header>
            <div class="main-right">
                <div class="card" style="width: 18rem;">
                    <a href="./news/news1.php"><img src="../assets/images/t1.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="./news/news1.php">Tác dụng Trầm Hương trong lối sống người Việt</a></h5>
                      <p class="card-text"><a href="./news/news1.php">Trầm Hương từ lâu đã đi sâu vào cuộc sống của người Việt Nam vì ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="./news/news2.php"><img src="../assets/images/t2.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="./news/news2.php">Trầm Hương là gì và cách nhận biết trầm hương</a></h5>
                      <p class="card-text"><a href="./news/news2.php">1. Trầm hương là gì ? Trầm hương (沉香, Agarwood), là tên gọi chung cho ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="./news/news3.php"><img src="../assets/images/t3.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="./news/news3.php">5 sản phẩm phổ biến được làm từ gỗ Trầm Hương</a></h5>
                      <p class="card-text"><a href="./news/news3.php">Gỗ Trầm Hương là loại gỗ đặc biệt nhất trong dân gian. Nó đem lại ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="./news/news4.php"><img src="../assets/images/t4.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="./news/news4.php">8 Mẹo phong thủy nhà ở hút tiền tài luôn được nhà giàu áp dụng</a></h5>
                      <p class="card-text"><a href="./news/news4.php">Không chỉ giỏi kiếm tiền, người giàu còn biết vận dụng những mẹo phong thủy ...</a></p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <a href="./news/news5.php"><img src="../assets/images/t5.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                      <h5 class="card-title"><a href="./news/news5.php">Nhang trầm hương nụ - tác dụng và cách thưởng thức trọn vẹn</a></h5>
                      <p class="card-text"><a href="./news/news5.php">Chúng ta vẫn thường biết đến Trầm Hương thông qua một số sản phẩm như ...</a></p>
                    </div>
                </div> 
            </div>
    
        </div>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="../assets/images/logo.png">
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
    <script>
        document.getElementById("profile-icon").addEventListener("click", function() {
            var menu = document.getElementById("profile-menu");
            
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        });
        window.addEventListener("click", function(event) {
            var menu = document.getElementById("profile-menu");
            var profile = document.querySelector(".profile");
            
            if (!profile.contains(event.target)) {
                menu.style.display = "none";
            }
        });
    </script>
    <script src="../assets/js/javascript.js"></script>
</body>
</html>