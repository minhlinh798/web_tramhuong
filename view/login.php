<?php
session_start();
include "../modules/connect.php"; // Kết nối đến database

// Xử lý ĐĂNG KÝ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu

    // Kiểm tra nếu email hoặc username đã tồn tại
    $checkQuery = "SELECT * FROM users WHERE email = ? OR username = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $email, $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email hoặc Username đã tồn tại!'); window.location.href = 'login.php';</script>";
    } else {
        // Thêm người dùng mới
        $insertQuery = "INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $full_name, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại!');</script>";
        }
        $stmt->close();
    }
    $checkStmt->close();
    $conn->close();
}

// Xử lý ĐĂNG NHẬP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) { // Kiểm tra mật khẩu
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "<script>alert('Đăng nhập thành công!'); window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Sai mật khẩu!');</script>";
        }
    } else {
        echo "<script>alert('Username không tồn tại!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng Nhập</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
            integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../assets/css/login.css">
    </head>
    <body style="display:flex; align-items:center; justify-content:center;">
        <div class="login-page">
            <div class="form">
                <!-- Form Đăng Ký -->
                <form class="register-form" action="login.php" method="POST">
                    <h2><i class="fas fa-lock"></i> Register</h2>
                    <input type="text" name="full_name" placeholder="Full Name *" required />
                    <input type="text" name="username" placeholder="Username *" required />
                    <input type="email" name="email" placeholder="Email *" required />
                    <input type="password" name="password" placeholder="Password *" required />
                    <button type="submit" name="register">Create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>
                <!-- Form Đăng Nhập -->
                <form class="login-form" action="login.php" method="POST">
                    <h2><i class="fas fa-lock"></i> Login</h2>
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <button type="submit" name="login">Login</button>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>