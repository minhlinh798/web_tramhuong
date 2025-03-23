<?php
include "../modules/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM bill WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa đơn hàng thành công.";
    } else {
        echo "Lỗi khi xóa đơn hàng: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng về trang lịch sử mua hàng
    header("Location: lsmuahang.php");
    exit();
}
?>
