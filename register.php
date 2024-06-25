<?php
// Kết nối đến cơ sở dữ liệu
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "sqlinjection_db";

$conn = new mysqli($hostname, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form đăng ký
$reg_username = $_POST['reg_username'];
$reg_password = $_POST['reg_password'];
$reg_email = $_POST['reg_email'];

// Mã hóa mật khẩu
// $hashed_password = password_hash($reg_password, PASSWORD_DEFAULT);

// Chuẩn bị và thực thi câu lệnh SQL để chèn dữ liệu vào bảng người dùng
$sql = "INSERT INTO users (user, pwd, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $reg_username, $reg_password, $reg_email);
//                                      $hashed_password
if ($stmt->execute()) {
     echo '<script>
                setTimeout(function() {
                    window.location.href = "index.php";
                }, 2000);
              </script>';
        echo "Đăng ký thành công!";
} else {
    echo "Lỗi: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
