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
    <link href="css/qldh.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>
<?php
    include "../modules/connect.php";

    $sql = "SELECT id_donhang, full_name, address, phone, tongtien, payment_method, order_date, order_status FROM thanhtoan ORDER BY order_date DESC";
    $result = $conn->query($sql);
?>
<div class="moemboo2">
    <h2>Quản Lý Các Đơn Hàng</h2>
    <table>
        <tr>
            <th>Stt</th>
            <th>Họ Và Tên</th>
            <th>Địa Chỉ</th>
            <th>Số Điện Thoại</th>
            <th>Tổng Tiền</th>
            <th>Phương Thức TT</th>
            <th>Thời gian</th>
            <th>Chi Tiết Đơn Hàng</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($result->num_rows > 0){$i=0;
                while($row = $result ->fetch_assoc()) {$i++;
        ?>
        <tr>
        <td><?php echo $i ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['tongtien']; ?> VNĐ</td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><a href="chitietdh.php?id=<?php echo $row['id_donhang']; ?>">Xem chi tiết</a></td>
            <td><a href="deletedh.php?id=<?php echo $row['id_donhang']; ?>">Xóa</a></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</div>
<?php
// Đóng kết nối
$conn->close();
?>
<?php
    include "script.php";
?>