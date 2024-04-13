

<?php
        $servername ="localhost";
        $username = "root";
        $password = "";
        $dbname = "shoppe_db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed". $conn->connect_error);
        }
        $email = $_POST["email"];
        $name = $_POST["name"]; 
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];
        //$result = $conn->query($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // $sql = "INSERT INTO user(email, password) VALUES ('$email', '$hashedPassword')";
        $check_query = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Email đã tồn tại trong cơ sở dữ liệu.";
            echo '<script>alert("Email already exists!");</script>';  
    } else {
        // Chèn dữ liệu vào cơ sở dữ liệu
        $insert_query = "INSERT INTO user (  email, name, password, address, gender) VALUES ('$email','$name', '$hashedPassword', '$address', '$gender')";
        if ($conn->query($insert_query) === TRUE) {
            header("Location: login.php"); // Chuyển hướng sang form login.php
            exit();
        } else {
            echo "Lỗi: " . $insert_query . "<br>" . $conn->error;
        }
    }
   
    // ?>
    
