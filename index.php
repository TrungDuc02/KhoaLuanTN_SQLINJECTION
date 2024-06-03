<!DOCTYPE html>
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
<!--
onkeyup="this.value = this.value.replace(/[^\w\s@.]/gi, '')"
onkeyup="this.value = this.value.replace(/[^\w\s]/gi, '')"

-->