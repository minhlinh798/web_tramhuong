<?php
session_start();
include "../modules/connect.php";

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập trước khi truy cập giỏ hàng.";
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$total_price = 0; // Khởi tạo tổng tiền

// Xử lý thêm sản phẩm vào giỏ hàng nếu có tham số id
if (isset($_GET['id'])) {
    $id_sanpham = intval($_GET['id']); // Chuyển đổi thành số nguyên để tránh lỗi SQL Injection

    // Lấy thông tin sản phẩm từ bảng `sanpham`
    $sql = "SELECT * FROM sanpham WHERE id_sanpham = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_sanpham);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $giasp = $product['giasp'];
        $ten_sanpham = $product['ten_sanpham'];
        $anh = $product['anh'];

        // Chuyển giasp thành số thực để tính toán
        $giasp = floatval(str_replace(',', '', $giasp));

        // Tính tổng tiền cho sản phẩm
        $tongtien = $giasp; // Tổng tiền là giá sản phẩm cho 1 sản phẩm

        if (!$anh) {
            echo "Sản phẩm không có hình ảnh!";
            exit;
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $check_cart = "SELECT * FROM giohang WHERE id_sanpham = ? AND user_id = ?";
        $stmt_cart = mysqli_prepare($conn, $check_cart);
        mysqli_stmt_bind_param($stmt_cart, "ii", $id_sanpham, $user_id);
        mysqli_stmt_execute($stmt_cart);
        $cart_result = mysqli_stmt_get_result($stmt_cart);

        if ($cart_result && mysqli_num_rows($cart_result) > 0) {
            // Nếu sản phẩm đã có trong giỏ hàng -> tăng số lượng và cập nhật tổng tiền
            $cart_item = mysqli_fetch_assoc($cart_result);
            $new_quantity = $cart_item['quantity'] + 1;
            $new_tongtien = $giasp * $new_quantity; // Tính lại tổng tiền

            // Cập nhật số lượng và tổng tiền
            $update_sql = "UPDATE giohang SET quantity = ?, tongtien = ? WHERE id_sanpham = ? AND user_id = ?";
            $stmt_update = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt_update, "diii", $new_quantity, $new_tongtien, $id_sanpham, $user_id);
            mysqli_stmt_execute($stmt_update);
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng -> thêm mới
            $giasp = floatval(str_replace(',', '', $product['giasp']));
            $tongtien = $giasp * 1;
            $insert_sql = "INSERT INTO giohang (id_sanpham, ten_sanpham, giasp, anh, quantity, user_id, tongtien) 
                            VALUES (?, ?, ?, ?, 1, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($stmt_insert, "isdsid", $id_sanpham, $ten_sanpham, $giasp, $anh, $user_id, $tongtien);
            if (!mysqli_stmt_execute($stmt_insert)) {
                echo "Lỗi khi thêm vào giỏ hàng: " . mysqli_error($conn);
                exit;
            }
        }

        // Chuyển hướng về trang giỏ hàng sau khi thêm sản phẩm
        header("Location: carts.php");
        exit;
    } else {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/cart.css">
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
    <style>
        button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #b5d745;
        }
        button:hover{
            background-color: #0a7908;
        }
        .cart-buttons button,
        .cart-buttons a {
            background-color: #ec10e4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s;
        }
        .cart-buttons button:hover,
        .cart-buttons a:hover {
            background-color: #e00f0f;
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
        h3 {
            color: #bf1f6a;
        }
    </style>
    <main>
        <div class="cart-container">
            <h1>Giỏ hàng của bạn</h1>
            <ul class="cart-items">
                <?php
                    $total_price = 0;
                    $query = "SELECT * FROM giohang WHERE user_id = ?";
                    $stmt_cart_list = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt_cart_list, "i", $user_id);
                    mysqli_stmt_execute($stmt_cart_list);
                    $result = mysqli_stmt_get_result($stmt_cart_list);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Chuyển đổi kiểu dữ liệu để tính toán
                            $giasp = floatval(str_replace(',', '', $row['giasp'])); 
                            $tongtien = floatval(str_replace(',', '', $row['tongtien']));
                    
                            $total_price += $tongtien;
                ?>
                <li class="cart-item">
                <img src="../admin/class/uploads/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_sanpham']; ?>">
                    <div class="item-details">
                        <span class="item-name"><?php echo $row['ten_sanpham']; ?></span>
                        <span class="item-price">Giá: <?php echo number_format($giasp, 0, ',', '.'); ?> VNĐ</span>
                    </div>
                    <div class="item-quantity">
                        <form action="updatesp.php" method="POST">
                            <input type="hidden" name="id_giohang" value="<?php echo $row['id_giohang']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $row['quantity']; ?>" min="1">
                            <button type="submit">Cập nhật</button>
                        </form>
                    </div>
                    <button class="remove-item"><a href="deletesp.php?id=<?php echo $row['id_giohang']; ?>">Xóa</a></button>
                </li>
                <?php
                        }
                    }
                ?>
            </ul>
            <div class="cart-total">
                <span>Tổng cộng:</span>
                <span class="total-price"><?php echo number_format($total_price, 0, ',', '.'); ?> VNĐ</span>
            </div>
            <div class="cart-buttons">
                <a href="./product.php" class="continue-shopping">Tiếp tục mua sắm</a>
                <button class="checkout">Đặt Hàng</button>
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
    <script src="../assets/js/carts.js"></script>
    <script src="../assets/js/javascript.js"></script>
</body>
</html>