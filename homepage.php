
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Management Form</title>
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
    input[type="submit"] {
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
    a{
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
        text-decoration: none;
    }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 20px auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Student Management Form</h2>
    <form action="addproduct.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
        
        <label for="studentCode">Student Code:</label>
        <input type="text" id="studentCode" name="studentCode" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        
        <input type="submit" value="Submit">
        <!-- <input type="edit" value="edit"> -->
        <!-- Trong vòng lặp foreach hiển thị bảng sinh viên -->


        <!-- <input type="delete" value="delete"> -->
    </form>
</div>
<table>
        <tr>
            <th>fullname</th>
            <th>studentCode</th>
            <th>phone</th>
            <th>gender</th>
            <th>email</th>
            <th>address</th>
            
        </tr>
        
<style>
/* CSS cho bảng */
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th {
    background-color: #f2f2f2;
}
</style>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoppe_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    // Hiển thị dữ liệu trên bảng
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            echo "<tr>";
            echo "<td>" . $row["fullName"] . "</td>";
            echo "<td>" . $row["studentCode"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>"; // Thêm nút Edit với ID của sinh viên
            echo "<td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>"; // Thêm nút Edit với ID của sinh viên

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No students found</td></tr>";
        
    }
    
    $conn->close();
    ?>
</table>


</body>
</html>
