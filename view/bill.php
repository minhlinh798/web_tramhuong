<?php
session_start();
include "../modules/connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; 
$tongtien = 0; // Khởi tạo tổng tiền

// Truy vấn giỏ hàng
$sql = "SELECT giohang.id_sanpham, giohang.quantity, sanpham.ten_sanpham, sanpham.giasp, sanpham.anh
        FROM giohang
        JOIN sanpham ON giohang.id_sanpham = sanpham.id_sanpham
        WHERE giohang.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Loại bỏ dấu phẩy nếu có
        $giasp = str_replace(',', '', $row['giasp']);
        $quantity = $row['quantity'];
        // Tính toán tổng tiền cho từng sản phẩm
        $item_total = $giasp * $quantity;
        $tongtien += $item_total;
        // Thêm thông tin tổng tiền vào mảng giỏ hàng
        $row['tongtien'] = $item_total;
        $cart_items[] = $row;
    }
}

if (empty($cart_items)) {
    echo "<script>
            alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
            window.location.href = 'carts.php'; // Chuyển hướng về trang giỏ hàng
          </script>";
    exit();
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['paymentMethod'];

    // Lưu đơn hàng vào bảng `thanhtoan`
    $sql = "INSERT INTO thanhtoan (user_id, full_name, phone, address, tongtien, payment_method) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssis", $user_id, $fullName, $phone, $address, $tongtien, $paymentMethod);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Lấy ID đơn hàng vừa tạo

        // Lưu chi tiết từng sản phẩm vào bảng `bill`
        foreach ($cart_items as $item) {
            $giasp = $item['giasp'];
            
            // Nếu giasp là NULL hoặc không phải là số, hãy đặt giá trị mặc định là 0
            if (is_null($giasp) || !is_numeric($giasp)) {
                $giasp = 0;
            }

            // Kiểm tra các tham số truyền vào có đúng không
            $sql = "INSERT INTO bill (order_id, id_sanpham, ten_sanpham, anh, quantity, giasp, tongtien, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iissiddi", 
                $order_id, 
                $item['id_sanpham'], 
                $item['ten_sanpham'], 
                $item['anh'], 
                $item['quantity'], 
                $giasp, 
                $item['tongtien'], 
                $user_id // Kiểm tra lại tham số user_id
            );
            $stmt->execute();
        }


        // Xóa giỏ hàng sau khi thanh toán thành công
        $sql = "DELETE FROM giohang WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Reset lại giỏ hàng trên giao diện
        unset($cart_items);
        $tongtien = 0;

        echo "<script>
        alert('Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ xử lý đơn hàng và giao đến bạn sớm nhất có thể.');
        window.location.href = 'lsmuahang.php';
        </script>";
    } else {
        echo "<script>alert('Lỗi thanh toán! Vui lòng thử lại sau.');</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/bills.css">
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
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #6c757d;
            border-radius: 8px;
            background-color: #fff;
            color: #333;
            appearance: none;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease-in-out;
        }
        select:hover, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }
        select {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%236c757d'><path d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
            padding-right: 30px;
        }
        select option {
            font-size: 16px;
            padding: 10px;
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
        <div class="header-bottom">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav class="header-line">
                <ul>
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="blog.php">Giới thiệu</a></li>
                    <li><a href="product.php">Sản Phẩm Trầm Hương</a></li>
                    <li><a href="news.php">Tin tức</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </nav>
            <div class="search">
                <form class="search-form" action="search.php" method="GET">
                    <input name="keyword" placeholder="Tìm kiếm sản phẩm" type="text" required>
                    <button type="submit" class="btn-search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <h1>THANH TOÁN</h1>
        <div class="container-bill">
            <div class="form-section">
                <form class="form-bill" action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="full_name" placeholder="Họ và Tên" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Địa chỉ nhận hàng" required>
                    </div>
                    <textarea name="noidung" placeholder="Nội dung"></textarea>

                    <h3>Chọn Phương Thức Thanh Toán</h3>
                    <select name="paymentMethod">
                        <option name="paymentMethod" value="COD">COD</option>
                        <option name="paymentMethod" value="payUrl">MOMO</option>
                    </select>
                    <div class="mb-3">
                        <label class="form-label">Tổng tiền:</label>
                        <h4 class="text-danger"><?php echo number_format($tongtien, 0, ',', '.'); ?> VNĐ</h4>
                        <input type="hidden" name="tongtien" value="<?php echo $tongtien; ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-credit-card"></i> Thanh Toán Ngay
                    </button>
                </form>
            </div>
            <div class="chitietdh">
                <h2>Chi Tiết Đơn Hàng:</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cart_items)): ?>
                            <?php foreach ($cart_items as $row): ?>
                                <tr>
                                    <td><img src="../admin/class/uploads/<?php echo $row['anh']; ?>" width="80" alt="Product Image"></td>
                                    <td><?php echo $row['ten_sanpham']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo number_format($row['tongtien'], 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Giỏ hàng của bạn trống</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
        // xử lý reset chi tiết sp
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_POST['submit'])): ?>
                // Khi thanh toán thành công, làm mới danh sách sản phẩm trong giỏ hàng
                document.querySelector(".chitietdh tbody").innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">Giỏ hàng của bạn trống</td>
                    </tr>
                `;
                // Cập nhật tổng tiền về 0
                document.querySelector(".mb-3 h4").innerText = "0 VNĐ";
            <?php endif; ?>
        });
        // Hàm thay đổi trạng thái đơn hàng sau 1 phút
        window.onload = function() {
            setTimeout(function() {
                fetch('updatetrangthai.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'update_status=true'
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Cập nhật trạng thái thành công: ' + data);
                })
                .catch(error => {
                    console.error('Lỗi: ', error);
                });
            }, 60000);
        };
    </script>
    <script src="../assets/js/javascript.js"></script>
</body>
</html>