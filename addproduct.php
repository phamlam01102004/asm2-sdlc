<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoppe_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý dữ liệu gửi từ biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $studentCode = $_POST["studentCode"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Chuẩn bị câu lệnh SQL để thêm dữ liệu vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO students (fullname, studentCode, phone, gender, email, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $studentCode, $phone, $gender, $email, $address);

    // Thực thi câu lệnh SQL
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
        header("Location: homepage.php");
    } else {
        echo "Error: " . $conn->error;
    }

    // Đóng câu lệnh
    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>

