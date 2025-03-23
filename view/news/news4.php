<?php
    session_start();
    include "../../modules/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lưu Trữ Tin Tức</title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="./news1.css">
    <link rel="stylesheet" href="../../assets/css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap v5/css/bootstrap.min.css">
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
                    <li><a href="../carts.php"><i class="bi bi-cart3" title="Giỏ hàng"></i> Giỏ hàng</a></li>
                </ul>
            </div>
            <div class="btn-login">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <!-- Nếu chưa đăng nhập, hiển thị nút Login -->
                    <button class="btn">
                        <a href="../login.php">Login</a>
                    </button>
                <?php } else { ?>
                    <!-- Nếu đã đăng nhập, hiển thị icon hồ sơ -->
                    <div class="profile-container">
                        <img src="../../assets/images/icons.png" width="40px" id="profile-icon">
                        <div class="dropdown-menu" id="profile-menu">
                            <a class="dropdown-item" href="#">Hồ Sơ</a>
                            <a class="dropdown-item" href="#">Cài Đặt</a>
                            <a class="dropdown-item" href="../lsmuahang.php">Lịch Sử Mua Hàng</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="../logout.php">Đăng Xuất</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="header-bottom">
            <div class="logo">
                <a href="../../index.php">
                    <img src="../../assets/images/logo.png" alt="tramhuong">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="../../index.php">Trang chủ</a></li>
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
       <div class="container">
            <header class="main-list">
                <h1>Tác dụng Trầm Hương trong lối sống người Việt</h1>
            </header>
            <div class="main-head">
                <p>Trầm Hương từ lâu đã đi sâu vào cuộc sống của người Việt Nam vì những tác dụng đặc biệt mà nó mang lại.<br>
                    Giờ đây không chỉ là sản vật quý hiếm mà Trầm Hương còn được xem là tâm hồn của người Việt.
                </p>
                <div class="main1-top">
                    <div class="top-main">
                        <ul>
                            <li><a href="#">Trầm Hương là gì và cách nhận biết trầm hương</a></li>
                            <li><a href="#">5 sản phẩm phổ biến được làm từ gỗ Trầm Hương</a></li>
                            <li><a href="#">8 Mẹo phong thủy nhà ở hút tiền tài luôn được nhà giàu áp dụng</a></li>
                            <li><a href="#">Nhang trầm hương nụ - tác dụng và cách thưởng thức trọn vẹn</a></li>
                        </ul>
                    </div>
                </div>
                <p>Không  phải ngẫu nhiên mà Trầm Hương xuất hiện nhiều trong đời sống hàng ngày như hiện nay. Người ta thường truyền tai nhau rằng gỗ trầm rất hiếm, rất khó có được.<br>
                    Tuy nhiên vì những giá trị và tác dụng diệu kỳ của Trầm Hương mà nhiều người vẫn sẵn sàng chi số tiền lớn để sở hữu.
                </p>
                <p>Trầm Hương trong văn hóa người Việt</p>
                <p><img src="../../assets/images/s1.png" alt="ảnh 1"></p>
                <p>Tác dụng của nhang Trầm trong cuộc sống</p>
                <p>Trầm Hương từ lâu đã đi vào tiềm thức của người Việt Nam từ những bó nhang trầm dâng lên đức Phật. Hương thơm tỏa ra dịu nhẹ, nồng ấm. Được xem là hương thơm tinh khiết<br>
                    nhất để tỏ lòng thành kính. Ngày này, người taq có xu hướng sử dụng nhiều hơn. Đặc biệt các gia đình có bàn thờ ông bà tổ tiên. Với mong muốn đem lại sự ấm cúng cho bàn thờ<br>
                    gia tiên nhà mình, cũng như trừ tà ma, đẩy lùi âm khí. Ngoài ra hương thơm từ nhang trầm cũng giúp con người thức tỉnh, đầy lùi tà ma, quay về chánh đạo.
                </p>
                <p><img src="../../assets/images/s2.png" alt="ảnh 22"><br>Vòng tay phong thủy thu hút may mắn, xua đuổi âm khí</p>
                <p>Ngày xưa chúng ta chỉ biết những chuỗi hạt Trầm Hương được sử dụng trong nhà Phật, là vật bất ly thân của thầy tu. Với mỗi bài tụng kinh, cầu nguyện thì chuỗi hạt chính là<br>
                    vật đánh dấu một vòng lặp lại. Nhưng đến ngày nay người ta có xu hướng sử đụng vòng tay Trầm nhiều hơn. Bởi vì những tác dụng hữu hình mà trầm hương đem lại<br>
                    khiến ai cũng mong muốn đem theo bên mình. Do đó vòng tay Trầm được xem như một món đồ trang sức vừa là món đồ phong thủy.
                </p>
                <p><img src="../../assets/images/s3.png" alt="ảnh 3"></p>
                <p>Tác dụng của tinh dầu Trầm</p>
                <p>Không còn quá xa lạ với người Viêt chúng ta bởi tinh dầu Trầm chính là sản phẩm quý hiếm. Với những tác dụng như giảm căng thẳng mệt mỏi, giúp thư giãn đầu óc,… .<br>
                    Nên ngày càng được săn đón trên thị trường. Có thể sử dụng bằng phương pháp xông tinh dầu hoặc sử dụng 1-2 giọt ngâm bồn tắm.<br>
                    Mùi hương nồng ấm, thanh thoát sẽ giúp cơ thể thả lỏng, giảm stress hiệu quả. Xông tinh dầu Trầm trong không gian nhà ở cũng đem lại vượng khí, đẩy lùi tà ma, thu hút may mắn cho gia chủ.
                </p>
                <p>Giá trị Trầm Hương Việt trên thị trường thế giới</p>
                <p>Từ những tác dụng tuyệt vời và độ hiếm có khó tìm thì ngày nay giá Trầm Hương được đẩy lên rất cao. Đối với những sản phẩm chìm trong nước có khi lên đến hàng tỷ đồng.<br>
                    Đối với thế giới, Trầm Hương Việt được đánh giá có giá trị cao nhất và xuất khẩu nhiều nhất hiện nay. Hàng năm ngành xuất khẩu Trầm Hương đem lại doanh thu lớn cho nền kinh tế<br>
                    Việt Nam. Đối với những thị trường khó tính như Hàn Quốc, Nhật Bản… trầm Việt vẫn có thể dễ dàng được ưa chuộng. Đây là điều đáng mừng đối với công nghiệp sản xuất Trầm.
                </p>
                <p>Tuy nhiên cũng chính vì những giá trị to lớn Trầm Hương đem lại nên hiện nay trên thị trường đã xuất hiện hàng giả, hàng nhái. Do đó hãy lựa chọn những địa điểm mua hàng uy tín.</p>
                <p>Trầm Hương dần đã đi sâu vào trong tâm trí và đời sống của người Việt Nam. Không chỉ có lợi ích trong cuộc sống hàng ngày mà còn đem lại những giá trị kinh tế cao.<br>
                    Vì vậy mới nói Trầm chính là tâm hồn của người Việt.
                </p>
            </div>
            <div class="main-form">
                <form class="row g-3">
                    <h3>Trả lời </h3>
                    <p>Email của bạn sẽ không được hiển thị công khai. Các trường bắt buộc được đánh dấu *</p>
                    <div class="col-md-4">
                      <label for="validationDefault01" class="form-label">Tên</label>
                      <input type="text" class="form-control" id="validationDefault01" required>
                    </div>
                    <div class="col-md-4">
                      <label for="validationDefault02" class="form-label">Email</label>
                      <input type="text" class="form-control" id="validationDefault02" required>
                    </div>
                    <div class="col-md-4">
                      <label for="validationDefaultUsername" class="form-label">Trang Web</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
                      </div>
                    </div>
                    <div class="text">
                        <textarea name="message" placeholder="Nội dung"></textarea>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                        <label class="form-check-label" for="invalidCheck2">
                            Lưu tên của tôi, email, và trang web trong trình duyệt này cho lần bình luận kế tiếp của tôi.
                        </label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary" type="submit">Phản Hồi</button>
                    </div>
                </form>
            </div>
       </div>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <img src="../../assets/images/logo.png" alt="logo">
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
    <script src="../../assets/js/javascript.js"></script>
</body>
</html>