<?php
session_start();
include "../modules/connect.php";

if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);

    $sql = "SELECT * FROM sanpham WHERE ten_sanpham LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);
} else {
    header("Location:product.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Sản Phẩm</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../assets/css/search.css">
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
                <input placeholder="Tìm kiếm sản phẩm" type="text">
                <button class="btn-search"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <style>
        .card-title a {
            font-size: 18px;
            /* font-weight: bold; */
            color: black;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .card-title a:hover {
            color:#007bff
        }
        p.card-text {
            font-size: 18px;
            font-weight: bold;
            color: #f3095d;
            text-align: center;
            margin-top: 20px;
        }
        h3 {
            color: #bf1f6a;
        }
    </style>
    <main>
        <div class="conmemner">
            <div class="btn-line">
                <button><a href="product.php">← Quay về trang sản phẩm</a></button>
            </div>
            <h2>Kết Quả Tìm Kiếm cho: "<?php echo htmlspecialchars($keyword); ?>"</h2>
            <div class="product">
                <div class="rowmen">
                    <?php if (mysqli_num_rows($result) > 0) { 
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="card" style="width: 18rem;">
                                <img src="../admin/class/uploads/<?php echo $row['anh']; ?>" class="card-img-top" alt="<?php echo $row['ten_sanpham']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="productdetail.php?id=<?php echo $row['id_sanpham']; ?>">
                                            <?php echo $row['ten_sanpham']; ?>
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        Giá: 
                                        <?php 
                                            if (!empty($row['giasp'])) {
                                                echo number_format($row['giasp'], 0, ',', '.') . " VND"; 
                                            } else {
                                                echo "Liên hệ";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                    <?php } 
                    } else { ?>
                        <p>Không tìm thấy sản phẩm nào.</p>
                    <?php } ?>
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
    <script src="../assets/js/javascript.js"></script>
</body>
</html>