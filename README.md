Ở đây em có 1 website bị dính lỗi SQL Injection
![image](https://github.com/TrungDuc02/KhoaLuanTN_SQLINJECTION/assets/96367070/54522ef8-b3fc-4c49-bfd8-747a357c9351)

Hình 3.17 Đoạn code bị dính lỗi SQL Injection
 ![image](https://github.com/TrungDuc02/KhoaLuanTN_SQLINJECTION/assets/96367070/0b252d7d-80c6-4f87-8812-10c9bba946bf)
 
Hình 3.18 Giao diện đăng nhập với câu lệnh  ' or 1=1--
Khi bị tấn công bằng phương pháp Boolean-based blind, chèn câu lệnh ' or 1=1-- vào form đăng nhập thì lập tức liệt kê tất cả các tài khoản có trong bảng users.

Trong trường hợp này, phần OR 1=1 luôn đúng, do đó điều kiện trong mệnh đề WHERE sẽ trả về kết quả đúng , cho phép liệt kê tất cả các tài khoản có trong bảng users.
 ![image](https://github.com/TrungDuc02/KhoaLuanTN_SQLINJECTION/assets/96367070/d0fb1602-2738-4fdf-b003-b11ed110f606)
Hình 3.19 Giao diện khi đăng nhập thành công với câu lệnh  ' or 1=1—

------PHƯƠNG PHÁP PHÒNG TRÁNH ------
+ Sử dụng các hàm lọc , không cho phép người dùng nhập vào các ký tự đặc biệt như: " , ` - # ,vv Chỉ cho phép nhập @ và dấu . đổi với các tài khoản là email.
+ Sử dụng hàm mysqli_real_escape_string để lọc các ký tự đb
+ Sử dụng các câu truy vấn tham số hóa như : Prepared Statements và Parameterized Queries
+ Mã hóa dữ liệu : mã hóa mật khẩu


-------UPDATE--------
Sửa lại giao diện
![image](https://github.com/TrungDuc02/KhoaLuanTN_SQLINJECTION/assets/96367070/9ceea7a2-d327-452b-b0ec-d906a08f949d)
Thêm chức năng đăng ký tài khoản 
![image](https://github.com/TrungDuc02/KhoaLuanTN_SQLINJECTION/assets/96367070/b3c0cf78-d35e-4fb1-9b51-a240eb87a510)

