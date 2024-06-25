<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        .result-container {
            margin-top: 20px;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
        }

        .result-table th,
        .result-table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .result-table th {
            background-color: #f2f2f2;
        }

        .logout-button {
            text-align: center;
            margin-top: 20px;
        }

        .logout-button button {
            padding: 8px 16px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
      if ($_POST) {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sqlinjection_db";

        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        if (!$conn) {
            die("Kết nối đến cơ sở dữ liệu thất bại");
        }
        $uname = $_POST["username"];
        $pass = $_POST["password"];

//     $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);



//     $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("ss", $uname, $pass);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $uname = mysqli_real_escape_string($conn, $uname);
//     $pass  = mysqli_real_escape_string($conn, $pass);


    $sql = "SELECT * FROM users WHERE user = '$uname' AND pwd ='$pass'";
    $result = mysqli_query($conn , $sql);



        if(mysqli_num_rows($result) >=1){
          $first_row = mysqli_fetch_assoc($result);
            $first_username = $first_row["user"];
            mysqli_data_seek($result, 0);
                echo '<div class="result-container">';
                echo '<h2>Xin chào <span style="color:red;">' . $first_username . '</span></h2>';
                echo '<table class="result-table">';
                echo '<tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Email</th>
                <th>FullName</th>
                <th>Date</th>
                <th>Phone</th>
                <th>Address</th>
                </tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    //Get value
                    $id = $row["id"];
                    $uname = $row["user"];
                    $email =  $row["email"];
                    $fname = $row["full_name"];
                    $date_of_birth = $row["date_of_birth"];
                    $phone_number = $row["phone_number"];
                    $address =  $row["address"];



                    echo '<tr>';
                    echo "<td>$id</td>";
                    echo "<td>$uname</td>";
                    echo "<td>$email</td>";
                    echo "<td>$fname</td>";
                    echo "<td>$date_of_birth</td>";
                    echo "<td>$phone_number</td>";
                    echo "<td>$address</td>";
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';

                // Thêm nút đăng xuất
                echo '<div class="logout-button">';
                echo '<button onclick="logout()">Đăng xuất</button>';
                echo '</div>';
            } else {
                echo '<div class="result-container">';
                echo '<h2 style="color:red;">Tên đăng nhập hoặc mật khẩu không chính xác !</h2>';
                echo '</div>';
            }
        }
        ?>

        <script>
            function logout() {
                window.location.href = "index.php";
            }
        </script>
    </div>
</body>
</html>