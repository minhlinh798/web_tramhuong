<?php
    include "../modules/connect.php";

    if (isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Truy vấn lấy số lượng sản phẩm
    $sql_sanpham = "SELECT COUNT(*) AS total_products FROM sanpham";
    $result_sanpham = mysqli_query($conn, $sql_sanpham);
    if (!$result_sanpham) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
    $row_sanpham = mysqli_fetch_assoc($result_sanpham);
    $total_products = $row_sanpham['total_products'];

    // Truy vấn lấy số lượng loại sản phẩm
    $sql_ten_danhmuc = "SELECT COUNT(DISTINCT ten_danhmuc) AS total_types FROM sanpham";
    $result_ten_danhmuc = mysqli_query($conn, $sql_ten_danhmuc);
    if ($result_ten_danhmuc) {
        $row_ten_danhmuc = mysqli_fetch_assoc($result_ten_danhmuc);
        $total_types = $row_ten_danhmuc['total_types'];
    } else {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Truy vấn lấy tổng doanh thu
    $sql_doanhthu = "SELECT SUM(tongtien) AS total_revenue FROM thanhtoan WHERE order_status = 'Giao Thành Công'";
    $result_doanhthu = mysqli_query($conn, $sql_doanhthu);
    if (!$result_doanhthu) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
    $row_doanhthu = mysqli_fetch_assoc($result_doanhthu);
    $total_revenue = $row_doanhthu['total_revenue'] ?? 0;  // Đảm bảo không bị NULL

    // Kiểm tra giá trị tổng doanh thu
    if ($total_revenue == 0) {
        echo "Doanh thu không có hoặc chưa có đơn hàng giao thành công.";
    } else {
        // echo "Tổng doanh thu: " . number_format($total_revenue, 0, ',', '.') . " VNĐ";
    }

    // Truy vấn lấy số lượng khách hàng
    $sql_khachhang = "SELECT COUNT(*) AS total_customers FROM users";
    $result_khachhang = mysqli_query($conn, $sql_khachhang);
    $row_khachhang = mysqli_fetch_assoc($result_khachhang);
    $total_customers = $row_khachhang['total_customers'];

    // Đóng kết nối sau khi hoàn thành truy vấn
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>
<div class="container">
 <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thống Kê</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tất Cả Sản Phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_products; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Loại Sản Phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_types; ?></div> <!-- Sửa lỗi ở đây -->
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Doanh Thu
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($total_revenue, 0, ',', '.'); ?> VNĐ</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Khách Hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_customers; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include "footer.php";
    include "script.php";
?>
