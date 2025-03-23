<?php
    include "../modules/connect.php";

    // Lấy ID đơn hàng từ URL
    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];

        $deleteBillQuery = "DELETE FROM bill WHERE order_id = ?";
        $stmt = $conn->prepare($deleteBillQuery);
        $stmt->bind_param("i", $order_id);
        if ($stmt->execute()) {
            $deleteOrderQuery = "DELETE FROM thanhtoan WHERE id_donhang = ?";
            $stmt = $conn->prepare($deleteOrderQuery);
            $stmt->bind_param("i", $order_id);
            if ($stmt->execute()) {
                echo "<script>
                        alert('Đơn hàng đã được xóa thành công!');
                        window.location.href = 'qldh.php';
                      </script>";
            } else {
                echo "<script>alert('Lỗi xóa đơn hàng!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Lỗi xóa bản ghi trong bảng bill!'); window.history.back();</script>";
        }
        $stmt->close();
    }

    $conn->close();
?>