<?php
include '../modules/connect.php';

$order_id = $_POST['order_id'];

if (!empty($order_id)) {
    $update_sql = "UPDATE bill SET trangthai = 'Giao Thành Công' WHERE id = ?";
    if ($stmt = $conn->prepare($update_sql)) {
        $stmt->bind_param("i", $order_id);
        if ($stmt->execute()) {
            echo "Trạng thái đã được cập nhật!";
        } else {
            echo "Lỗi khi cập nhật trạng thái!";
        }
        $stmt->close();
    }
} else {
    echo "Không có ID đơn hàng!";
}
$conn->close();
?>
