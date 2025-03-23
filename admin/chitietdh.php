<?php
include "../modules/connect.php";

// Lấy id đơn hàng từ URL
$order_id = $_GET['id'];

// Lấy thông tin chi tiết đơn hàng
$sql = "SELECT * FROM thanhtoan WHERE id_donhang = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

// Lấy thông tin sản phẩm trong đơn hàng
$sql_items = "SELECT * FROM bill WHERE order_id = ?";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_sanpham = $_POST['ten_sanpham'];
    $giasp = $_POST['giasp'];
    $quantity = $_POST['quantity'];

    // Xử lý upload ảnh
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["anh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
        $anh = basename($_FILES["anh"]["name"]); // Lưu tên file vào database

        // Chèn dữ liệu vào bảng bill
        $sql = "INSERT INTO bill (ten_sanpham, anh, giasp, quantity, tongtien) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $tongtien = $giasp * $quantity;
        $stmt->bind_param("ssddd", $ten_sanpham, $anh, $giasp, $quantity, $tongtien);

        if ($stmt->execute()) {
            echo "Thêm sản phẩm thành công!";
        } else {
            echo "Lỗi khi thêm sản phẩm: " . $stmt->error;
        }
    } else {
        echo "Lỗi khi upload ảnh.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="detail-order">
        <button onclick="window.location.href='qldh.php';" class="btn btn-primary">Quay lại danh sách đơn hàng</button>
        <h2>Chi Tiết Đơn Hàng</h2>

        <div class="order-info">
            <p><strong>Tên khách hàng:</strong> <?php echo $order['full_name']; ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $order['address']; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $order['phone']; ?></p>
            <p><strong>Tổng tiền:</strong> <?php echo number_format($order['tongtien'], 2); ?> VNĐ</p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo $order['payment_method']; ?></p>
            <p><strong>Trạng thái:</strong> <?php echo $order['order_status']; ?></p>
            <p><strong>Ngày đặt:</strong> <?php echo $order['order_date']; ?></p>
        </div>

        <h3>Chi Tiết Sản Phẩm</h3>
        <table class="table-order">
            <tr>
                <th>Ảnh Sản Phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            <?php while ($item = $items_result->fetch_assoc()) { ?>
            <tr>
            <td><img src="../admin/class/uploads/<?php echo $item['anh']; ?>" alt="<?php echo $item['ten_sanpham']; ?>" width="100"></td>
                <td><?php echo $item['ten_sanpham']; ?></td>
                <td><?php echo number_format($item['giasp'], 2); ?> VNĐ</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($item['giasp'] * $item['quantity'], 2); ?> VNĐ</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
<?php
// Đóng kết nối
$conn->close();
?>

<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fc;
        margin: 0;
        padding: 0;
    }
    h2 {
        font-size: 2rem;
        color: #4e73df;
        margin-bottom: 20px;
        text-align: center;
    }
    .detail-order {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .order-info p {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #555;
    }
    .order-info p strong {
        color: #333;
    }
    .table-order {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .table-order th,
    .table-order td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .table-order th {
        background-color: #4e73df;
        color: white;
    }
    .table-order td {
        font-size: 1rem;
    }
    a:hover {
        color: #4e73df;
        text-decoration: underline;
    }
    button {
        padding: 10px 20px;
        font-size: 1rem;
        color: white;
        background-color: #4e73df;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    button:hover {
        background-color: #3e59b9;
        transform: translateY(-2px);
    }
    button:active {
        background-color: #2f4a90;
        transform: translateY(2px);
    }
    button:focus {
        outline: none;
    }
</style>