<?php
include "../modules/connect.php";

if (isset($_POST['update_status'])) {
    $sql = "UPDATE thanhtoan SET order_status = 'Giao Thành Công' WHERE order_status = 'Đang Giao Hàng'";
    if ($conn->query($sql) === TRUE) {
        echo "Trạng thái đơn hàng đã được cập nhật.";
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}
?>
