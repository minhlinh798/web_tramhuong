<?php
session_start();
include "../modules/connect.php";

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để xem lịch sử mua hàng.";
    exit;
}
// Lấy user_id từ session
$user_id = $_SESSION['user_id'];

// Truy vấn dữ liệu từ bảng "bill" chỉ lấy các đơn hàng của user_id cụ thể
$sql = "SELECT * FROM bill WHERE user_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lịch Sử Mua Hàng</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/bootstrap v5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
     <!-- Header -->
     <header>
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
                padding-left: 210px;
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
            <nav class="header-line">
                <ul>
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="./blog.php">Giới thiệu</a></li>
                    <li><a href="./product.php">Sản Phẩm Trầm Hương</a></li>
                    <li><a href="./news.php">Tin tức</a></li>
                    <li><a href="./contact.php">Liên hệ</a></li>
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
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html,
        body {
            position: relative;
            height: 100%;
            margin: auto;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #ffff;
        }
        .header-top {
            background-color: #2C5F2D;
            color: rgb(246, 132, 10);
            display: flex;
            justify-content: space-between;
            padding: 10px 50px;
            font-size: 15px;
        }
        .left p {
            font-weight: bold;
        }
        .left {
            padding-left: 150px;
        }
        .header-top .right ul {
            list-style: none;
            display: flex;
            gap: 15px;
        }
        .header-top .right ul li a {
            color: white;
            text-decoration: none;
        }
        .header-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #97BC62;
            padding: 0px 200px;
        }
        .logo img {
            width: 200px;
            height: 80px;
        }
        .header-line ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .header-line ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            /* font-weight: bold; */
        }
        .header-line ul li a:hover {
            color:#2C5F2D;
        }
        .search {
            display: flex;
            /* align-items: center; */
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }
        .search input {
            border: none;
            padding: 8px;
            outline: none;
        }
        .search button {
            background: #00246B;
            border: none;
            padding: 8px;
            color: white;
            cursor: pointer;
        }
        .search button:hover{
            background-color:#CADCFC;
        }
        /* Định dạng cho phần main */
        .container-main {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        td a {
            margin-right: 10px;
        }
        /* Định dạng chung cho footer */
        .footer-top {
            background-color: #97BC62;
            color: rgb(14, 13, 13);
            padding: 40px 0;
        }
        .footer-top .container {
            max-width: 1200px;
            margin: auto;
        }
        .footer-top .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .footer-top .col {
            flex: 1;
            min-width: 250px;
            padding: 20px;
        }
        .footer-top img {
            max-width: 230px;
            margin-bottom: 15px;
            transition: transform 0.3s ease-in-out;
        }
        .footer-top img:hover {
            transform: scale(1.05);
        }
        .footer-top h3 {
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #f1c40f;
            display: inline-block;
            padding-bottom: 5px;
        }
        .footer-top p {
            font-size: 14px;
            line-height: 1.6;
            transition: all 0.3s ease-in-out;
        }
        .footer-top p:hover {
            color: #d86310;
            transform: scale(1.02); /* Hiệu ứng nhẹ khi rê chuột */
        }
        .footer-top a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
            display: inline-block;
        }
        .footer-top a:hover {
            color: #007bff;
            transform: translateX(5px);
        }
        .footer-top i {
            margin:8px;
            transition: transform 0.3s ease-in-out;
        }
        .footer-top a:hover i {
            transform: scale(1.2);
        }
        h3 {
            color: #bf1f6a;
        }
        /* Định dạng phần footer-bottom */
        .footer-bottom {
            text-align: center;
            background-color: #2C5F2D;
            padding: 15px 0;
            color: black;
            font-weight: bold;
        }
        .footer-bottom span {
            font-weight: bold;
        }
    </style>
    <!-- Main Content -->
    <main>
        <div class="container-main">
            <h1>Lịch Sử Mua Hàng</h1>
            <table class="order-history">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Thời Gian</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Hiển thị dữ liệu
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['ten_sanpham'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . number_format($row['tongtien'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td class='status' data-id='" . $row['id'] . "'>" . ($row['trangthai'] ? $row['trangthai'] : 'Đang Giao Hàng') . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td><a href='deletedh.php?id=" . $row['id'] . "'>Xóa</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Không có đơn hàng nào</td></tr>";
                    }                    

                    // Đóng kết nối
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="../assets/images/logo.png" alt="logo">
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
        // Hàm thay đổi trạng thái đơn hàng sau 1 phút
        window.onload = function() {
            setTimeout(function() {
                let orders = document.querySelectorAll('.status');
                orders.forEach(function(order) {
                    if (order.innerText === 'Đang Giao Hàng') {
                        order.innerText = 'Giao Thành Công';
                        let orderId = order.getAttribute('data-id');
                        
                        fetch('updatedh.php', {
                            method: 'POST',
                            body: new URLSearchParams({
                                'order_id': orderId
                            })
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Cập nhật trạng thái thành công: ' + data);
                        })
                        .catch(error => {
                            console.error('Có lỗi xảy ra: ', error);
                        });
                    }
                });
            }, 60000);
        };
        // Hàm xử lý profile
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