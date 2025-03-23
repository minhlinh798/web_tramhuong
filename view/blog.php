<?php
    session_start();
    include "../modules/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/blog.css">
    <link rel="stylesheet" href="../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/bootstrap v5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
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
    </style>
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
                            <a class="dropdown-item" href="profile.php">Hồ Sơ</a>
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
        <div class="container">
            <style>
                .container {
                    max-width: 1100px;
                    margin: 0 auto;
                    padding: 20px;
                }
            </style>
            <header>
                <h1>Giới thiệu</h1>
                <div class="header-main">
                    <h2>Trầm Hương Tiên Phước</h2>
                </div>
            </header>
            <div class="main-top">
                <div class="main-list">
                    <p>Trầm Hương Tự Nhiên hiện nay là một trong số những sản phẩm phong thủy được rất nhiều khách hàng lựa chọn sử dụng mang lại nhiều may mắn,<br>
                        tài lộc và sự bình an trong tâm người sở hữu.
                    </p>
                    <p>Trầm Hương Tiên Phước là địa chỉ uy tín tại Quảng Nam hiện nay cung cấp các sản phẩm trầm hương chuẩn tự nhiên với chất lượng đảm bảo mức giá<br>
                        thành hợp lý. Tất cả các sản phẩm trầm hương được bán tại xưởng đều là hàng Việt Nam có chế độ bảo hành đầy đủ, cam kết trầm chuẩn tự nhiên<br>
                        núi rừng Quảng Nam vì thế khách hàng có thể hoàn toàn yên tâm sử dụng.
                    </p>
                    <p>Trầm Hương Tiên Phước cung cấp các sản phẩm như:</p>
                    <ul>
                        <li>Nhang, nụ Trầm hương sạch</li>
                        <li>Bột trầm hương</li>
                        <li>Kiến kim xông đốt, ngâm rượu, pha trà</li>
                        <li>Vòng tay trầm hương</li>
                        <li>Tinh dầu trầm hương</li>
                        <li>Tượng gỗ, phật bản mệnh phong thuỷ từ gỗ trầm hương thiên nhiên</li>
                        <li>Mặt dây chuyền trầm hương</li>
                        <li>Trầm cảnh nguyên khối thiên nhiên</li>
                        <li>Các loại phụ kiện: lò đốt hương trầm, quà tặng cao cấp từ trầm hương,…</li>
                    </ul>
                    <p id="one"><img src="../assets/images/e1.png" alt="ảnh 1" widtd="600px" height="600px">vòng trầm thiên nhiên</p>
                    <p>Các sản phẩm từ gỗ trầm hương luôn được chọn lọc phôi kĩ lưỡng, gia công tỉ mỉ, và làm hoàn toàn thủ công bằng tay, để đảm bảo chất lượng cho  sản phẩm và mang lại giá trị cao về mặt phong thủy cho người sử dụng.</p>
                    <p>Lý do bạn nên chọn mua vòng tay gỗ trầm hương tại TRẦM HƯƠNG TIÊN PHƯỚC:</p>
                    <p>- Trầm Hương Tiên Phước nối nghiệp nghề làm trầm của cha ông bao đời nay, luôn từng bước đẩy mạnh, phát triển mang các sản phẩm thành phẩm trầm hương cao cấp và Vip đến để phục vụ thượng khách mê trầm ở mọi miền tổ quốc, luôn cam kết mang đến những sản phẩm tốt, chất lượng và đúng chuẩn nhất.</p>
                    <p>- Trầm Hương Tiên Phước đã có nhiều năm hoạt động và phát triển, tự thu mua, tự sản xuất, tự cung cấp tận tay đến khách hàng đảm bảo chất lượng tuyệt đối nhất đến tay khách hàng.</p>
                    <p>- Chúng tôi có đội ngũ nghệ nhân lâu năm, lành nghề và luôn tỉ mĩ về sản phẩm, cũng như cung cấp những dịch vụ tốt nhất tới khách hàng.</p>
                    <p>Mọi thắc mắc hay có nhu cầu trao đổi gì về Trầm Hương mọi người có thể lên hệ cho chúng tôi. Rất vui lòng hỗ trợ cũng như trao dồi với mọi người về những kiến thức mà chúng tôi có được về Trầm Hương .</p>
                    <p>Và bạn muốn sở hữu một sản phẩm trầm hương đẹp tạo nên phong cách sang trọng và quý phái thì còn chần chờ gì mà không liên hệ ngay với TRẦM HƯƠNG TIÊN PHƯỚC để được tư vấn thật chi tiết!</p>
                    <p>Thông tin liên hệ:</p>
                    <p>TRẦM HƯƠNG TIÊN PHƯỚC</p>
                    <p>Địa chỉ: Thôn Địch Tây, Tiên Phong, Tiên Phước, Quảng Nam</p>
                    <p>Email: linhclear@gmail.com</p>
                    <p>Hotline: 0337 263 708</p>
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