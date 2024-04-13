<?php
// Kiểm tra xem ID sinh viên đã được truyền qua URL chưa
if (isset($_GET['id'])) {
    // Lấy ID sinh viên từ URL
    $student_id = $_GET['id'];

    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoppe_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu của sinh viên cần chỉnh sửa
    $sql = "SELECT * FROM students WHERE id = $student_id";
    $result = $conn->query($sql);

    // Kiểm tra xem có dữ liệu hay không
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit(); // Thoát khỏi trang nếu sinh viên không tồn tại
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Student ID is missing.";
    exit(); // Thoát khỏi trang nếu thiếu ID sinh viên
}

// Xử lý form nếu được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý xóa sinh viên nếu có yêu cầu
    if (isset($_POST['delete'])) {
        // Kết nối lại đến cơ sở dữ liệu
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Truy vấn xóa sinh viên có ID tương ứng
        $sql_delete = "DELETE FROM students WHERE id = $student_id";

        if ($conn->query($sql_delete) === TRUE) {
            header("Location: homepage.php"); // Chuyển hướng sang form login.php
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $conn->close();
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Student</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 50%;
        margin: 20px auto;
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 8px;
    }
    h2 {
        text-align: center;
    }
    form {
        margin-top: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"], input[type="email"], select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"], input[type="button"] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Delete Student</h2>
    <form action="edit.php" method="post">
        <!-- Trường ẩn để lưu ID sinh viên -->
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullName']; ?>" required>
        
        <label for="studentCode">Student Code:</label>
        <input type="text" id="studentCode" name="studentCode" value="<?php echo $row['studentCode']; ?>" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select gender</option>
            <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if ($row['gender'] == 'other') echo 'selected'; ?>>Other</option>
        </select>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required>
        
        <input type="submit" value="Submit">
        <input type="button" value="Delete" onclick="deleteStudent()">
    </form>
</div>

<script>
    function deleteStudent() {
        if (confirm('Are you sure you want to delete this student?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>

<form id="deleteForm" action="" method="post">
    <input type="hidden" name="delete" value="true">
</form>

</body>
</html>
