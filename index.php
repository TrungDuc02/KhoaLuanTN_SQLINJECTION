<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>SQL Injection</title>
    <style>
        .hidden {
            display: none;
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            display: flex; /* Center the modal */
            justify-content: center; /* Center the modal */
            align-items: center; /* Center the modal */
        }
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 300px; /* Could be more or less, depending on screen size */
            text-align: center; /* Center the text */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 5px 15px rgba(0,0,0,0.3); /* Add shadow */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .form-container .switch-btn {
            background-color: #007BFF;
            margin-top: 10px;
        }
        .form-container .switch-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="mainContent">
        <div id="loginForm" class="form-container">
            <h1 id="loginTitle">Đăng nhập</h1>
            <!-- Form đăng nhập -->
            <form method="post" action="check_login_index.php" autocomplete="off">
                <label for="un">Tên đăng nhập</label><br />
                <input class="input-field" type="text" name="username" id="un" placeholder="Tên đăng nhập" required /><br />

                <label for="pass">Mật khẩu</label><br />
                <input class="input-field" type="password" name="password" id="pass" placeholder="Mật khẩu" required /><br />

                <label class="show-password-label">
                    <input type="checkbox" id="showPassword" class="show-password-checkbox" onclick="togglePasswordVisibility()" />
                    Hiển thị mật khẩu
                </label><br />

                <button type="submit" id="btn" name="login">Đăng nhập</button>
                <button type="button" class="switch-btn" onclick="showRegistrationForm()">Đăng ký</button>
            </form>
        </div>

        <!-- Form đăng ký -->
        <div id="registrationForm" class="form-container hidden">
            <h1 id="registerTitle">Đăng ký</h1>
            <form id="registerForm" method="post" action="register.php" autocomplete="off" onsubmit="return validateForm()">
                <label for="reg_un">Tên đăng nhập</label><br />
                <input class="input-field" type="text" name="reg_username" id="reg_un" placeholder="Tên đăng nhập" required /><br />

                <label for="reg_pass">Mật khẩu</label><br />
                <input class="input-field" type="password" name="reg_password" id="reg_pass" placeholder="Mật khẩu" required /><br />

                <label for="confirm_pass">Nhập lại mật khẩu</label><br />
                <input class="input-field" type="password" name="confirm_password" id="confirm_pass" placeholder="Nhập lại mật khẩu" required /><br />

                <label for="reg_email">Email</label><br />
                <input class="input-field" type="email" name="reg_email" id="reg_email" placeholder="vd:duc@gmail.com" required /><br />

                <label class="show-password-label">
                    <input type="checkbox" id="showRegPassword" class="show-password-checkbox" onclick="toggleRegPasswordVisibility()" />
                    Hiển thị mật khẩu
                </label><br />

                <button type="submit" id="reg_btn" name="register">Đăng ký</button>
                <button type="button" class="switch-btn" onclick="showLoginForm()">Quay lại Đăng nhập</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="errorModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Mật khẩu và nhập lại mật khẩu không khớp!</p>
        </div>
    </div>
    <script src="script.js"> </script>
</body>
</html>











<!--<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>SQL Injection</title>
  </head>
  <body>
    <h1>Đăng nhập </h1>
    <form method="post" action="check_login_index.php" autocomplete="off">
  <input type="text" name="username" id="un" value="" placeholder="Tên đăng nhập"  /><br />
  <input type="password" name="password" id="pass" value="" placeholder="Mật khẩu"  /><br />
      <label class="show-password-label">
        <input type="checkbox" id="showPassword" class="show-password-checkbox" onclick="togglePasswordVisibility()" />
        Hiển thị mật khẩu
      </label>
      <input type="submit" id="btn" name="login" value="Đăng nhập" />
    </form>

    <script src="script.js"></script>
  </body>
</html>
-->

<!--
onkeyup="this.value = this.value.replace(/[^\w\s@.]/gi, '')"
onkeyup="this.value = this.value.replace(/[^\w\s]/gi, '')"

-->