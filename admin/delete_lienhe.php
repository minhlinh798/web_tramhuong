<?php
include "../modules/connect.php";

if (isset($_GET['id'])) {
    $id_lienhe = intval($_GET['id']); // Chuyển đổi giá trị thành số nguyên để tránh lỗi SQL Injection

    // Câu lệnh xóa
    $sql = "DELETE FROM lienhe WHERE id_lienhe = $id_lienhe";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thông tin liên hệ thành công.";
    } else {
        echo "Lỗi khi xóa thông tin: " . $conn->error;
    }
} else {
    echo "ID liên hệ không được cung cấp.";
}
header("Location: support.php");
exit();

// Đóng kết nối
$conn->close();
?>
