/**/Default web
<?php
// Kết nối đến cơ sở dữ liệu MySQL
$hostname ="localhost";
$username = "root";
$password = "";
$dbname = "sqlinjection_db";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
die("Kết nối đến cơ sở dữ liệu thất bại: ");
}
if($_POST){
$uname = $_POST["username"];
$pass = $_POST["password"];

$sql = "SELECT * FROM users WHERE user = '$uname' AND pwd ='$pass'";
$result = mysqli_query($conn , $sql);
if(mysqli_num_rows($result) >=1){
    echo "Xin chao";
    while( $row = mysqli_fetch_assoc($result)){
        $id = $row["id"];
        $uname = $row["user"];


        echo" <pre>ID: {$id} <br> />UserName: {$uname}</pre>";
    }
}else{
    echo"Ten dang nhap hoac mat khau sai";
}
}
?>



/****/Chong bang Prepared Statements.
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

    // Sử dụng prepared statements
    $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) >= 1) {
        echo '<div class="result-container">';
        echo '<h2>Xin chào</h2>';

        echo '<table class="result-table">';
        echo '<tr><th>ID</th><th>UserName</th><th>FullName</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            // Lấy giá trị
            $id = $row["id"];
            $uname = $row["user"];
            $fname = $row["full_name"];

            echo '<tr>';
            echo "<td>$id</td>";
            echo "<td>$uname</td>";
            echo "<td>$fname</td>";
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
Sử dụng câu lệnh Prepared Statements: Prepared Statements (còn được gọi là parameterized queries) là một phương pháp chống SQL Injection mạnh mẽ. 
Thay vì tạo truy vấn SQL bằng cách kết hợp chuỗi đầu vào, bạn sẽ tạo một truy vấn với các tham số (placeholders) và 
sau đó gán giá trị cho các tham số đó. Điều này giúp trình cơ sở dữ liệu phân biệt giữa các dữ liệu và câu lệnh SQL, 
ngăn chặn các cuộc tấn công SQL Injection. Sử dụng các giao diện chuẩn như MySQLi hoặc PDO để tạo và thực thi Prepared Statements


Trong phiên bản cải thiện này, chúng ta đã sử dụng Prepared Statements thay vì dùng mysqli_real_escape_string() để bảo vệ khỏi SQL Injection. Các bước thực hiện như sau:

Chuẩn bị câu truy vấn sử dụng Prepared Statements: $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";

Tạo đối tượng Prepared Statements: $stmt = mysqli_prepare($conn, $sql);

Gắn các giá trị vào Prepared Statements: mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);

Thực thi Prepared Statements: mysqli_stmt_execute($stmt);

Lấy kết quả truy vấn: $result = mysqli_stmt_get_result($stmt);

Bằng cách sử dụng Prepared Statements, các giá trị của $uname và $pass sẽ được chèn vào truy vấn một cách an toàn mà không gây nguy cơ SQL Injection.




//Preventing SQL Injection
            //loai bo ky tu dac biet (chan ky tu la)
            //Hàm mysqli_real_escape_string() sẽ trả về một chuỗi đã được xử lý và thoát các ký tự đặc biệt. 
            //Sau khi xử lý này, chuỗi đã được lọc có thể sử dụng an toàn trong câu truy vấn SQL mà không gây ra lỗi hoặc tạo điều kiện cho các cuộc tấn công SQL Injection.
            
        <?php      
        $uname = mysqli_real_escape_string($conn, $uname);  
         $pass  = mysqli_real_escape_string($conn, $pass);
        ?>


// SU dung  Prepared Statements:
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
    
        $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) >= 1) {
                echo '<div class="result-container">';
                echo '<h2>Xin chào</h2>';

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

//Khai báo câu truy vấn SQL với hai tham số.
        $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";

        //Chuẩn bị câu truy vấn SQL và trả về một đối tượng Prepared Statement.
        $stmt = mysqli_prepare($conn, $sql);

        // Gắn các giá trị tham số vào câu truy vấn.
        mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);

        //Thực thi câu truy vấn đã chuẩn bị trước.
        mysqli_stmt_execute($stmt);

        //: Lấy kết quả của câu truy vấn trong một đối tượng mysqli_result.
        $result = mysqli_stmt_get_result($stmt);









// Su dung Parameterized Queries


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

    $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    // Xử lý kết quả
    if ($result->num_rows >= 1) {
        echo '<div class="result-container">';
        echo '<h2>Xin chào</h2>';

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

<?php
       // Câu lệnh SQL có chứa các tham số (dấu ? sẽ được thay thế bởi các giá trị thực tế)
       $sql = "SELECT * FROM users WHERE user = ? AND pwd = ?";

       // Chuẩn bị câu lệnh SQL với kết nối $conn và lưu nó vào biến $stmt
       $stmt = $conn->prepare($sql);

       // Gắn kết các giá trị thực tế của các biến $uname và $pass vào các tham số trong câu lệnh SQL
       // "ss" nghĩa là cả hai tham số đều là kiểu string
       $stmt->bind_param("ss", $uname, $pass);

       // Thực thi câu lệnh SQL đã chuẩn bị với các giá trị tham số đã được gắn
       $stmt->execute();

       // Lấy kết quả của truy vấn và lưu vào biến $result
       $result = $stmt->get_result();
?>

// Prepared Statements với PDO
<?php
   // Khai báo câu truy vấn SQL với hai tham số được đặt tên là :username và :password.
   $sql = "SELECT * FROM users WHERE user = :username AND pwd = :password";

   // Chuẩn bị câu truy vấn SQL bằng cách sử dụng phương thức prepare() của đối tượng PDO $conn.
   $stmt = $conn->prepare($sql);

   // Gắn biến $uname vào tham số :username của câu truy vấn.
   // bindParam() được sử dụng để gắn các giá trị tham số vào câu truy vấn.
   $stmt->bindParam(':username', $uname, PDO::PARAM_STR);

   // Gắn biến $pass vào tham số :password của câu truy vấn.
   $stmt->bindParam(':password', $pass, PDO::PARAM_STR);

   // Thực thi câu truy vấn đã chuẩn bị.
   $stmt->execute();

   // Lấy kết quả của câu truy vấn dưới dạng một mảng liên hợp, sử dụng fetchAll() với tham số PDO::FETCH_ASSOC.
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Xử lý kết quả
   if (count($result) >= 1) {
       // Có ít nhất một kết quả thỏa mãn điều kiện truy vấn
       // Xử lý tại đây
   }


?>


        //Preventing SQL Injection
        //loai bo ky tu dac biet (chan ky tu la)
        //Hàm mysqli_real_escape_string() sẽ trả về một chuỗi đã được xử lý và thoát các ký tự đặc biệt.
        //Sau khi xử lý này, chuỗi đã được lọc có thể sử dụng an toàn trong câu truy vấn SQL mà không gây ra lỗi hoặc tạo điều kiện cho các cuộc tấn công SQL Injection.
        //$uname = mysqli_real_escape_string($conn, $uname);
        //$pass  = mysqli_real_escape_string($conn, $pass);

//Sử dụng Prepared Statements với PDO
<?php
if ($_POST) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    // Câu lệnh SQL có chứa các tham số (dấu :user và :pwd sẽ được thay thế bởi các giá trị thực tế)
    $sql = "SELECT * FROM users WHERE user = :user AND pwd = :pwd";

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);

    // Gắn các giá trị thực tế vào các tham số
    $stmt->bindParam(':user', $uname);
    $stmt->bindParam(':pwd', $pass);

    // Thực thi câu lệnh SQL đã chuẩn bị với các giá trị tham số đã được gắn
    $stmt->execute();

    // Lấy kết quả của truy vấn
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra số lượng hàng trả về
    if (count($result) >= 1) {
        // Xử lý khi có ít nhất một hàng dữ liệu trả về
        $first_row = $result[0]; // Lấy hàng đầu tiên từ tập kết quả
        $first_username = $first_row["user"]; // Lấy tên người dùng từ hàng đầu tiên

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

        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["user"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td>' . $row["full_name"] . '</td>';
            echo '<td>' . $row["date_of_birth"] . '</td>';
            echo '<td>' . $row["phone_number"] . '</td>';
            echo '<td>' . $row["address"] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';

        // Thêm nút đăng xuất
        echo '<div class="logout-button">';
        echo '<button onclick="logout()">Đăng xuất</button>';
        echo '</div>';
    } else {
        // Hiển thị thông báo lỗi nếu không có hàng nào trả về
        echo '<div class="result-container">';
        echo '<h2 style="color:red;">Tên đăng nhập hoặc mật khẩu không chính xác !</h2>';
        echo '</div>';
    }
}
?>

















$sql = "SELECT * FROM users WHERE user = :user AND pwd = :pwd";

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);

    // Gắn các giá trị thực tế vào các tham số
    $stmt->bindParam(':user', $uname);
    $stmt->bindParam(':pwd', $pass);

    // Thực thi câu lệnh SQL đã chuẩn bị với các giá trị tham số đã được gắn
    $stmt->execute();

    // Lấy kết quả của truy vấn
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
























/**/Web bi loi sql Injection
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
    
        //Preventing SQL Injection
        //loai bo ky tu dac biet (chan ky tu la)
        //Hàm mysqli_real_escape_string() sẽ trả về một chuỗi đã được xử lý và thoát các ký tự đặc biệt. 
        //Sau khi xử lý này, chuỗi đã được lọc có thể sử dụng an toàn trong câu truy vấn SQL mà không gây ra lỗi hoặc tạo điều kiện cho các cuộc tấn công SQL Injection.
        
        
        // $uname = mysqli_real_escape_string($conn, $uname);  
        // $pass  = mysqli_real_escape_string($conn, $pass);

        $sql = "SELECT * FROM users WHERE user = '$uname'  AND pwd ='$pass'";    //sau and or 1=1--
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >= 1) {
                echo '<div class="result-container">';
                echo '<h2>Xin chào</h2>';

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