
// Chuyển đổi chế độ hiển thị cho mật khẩu đăng nhập
function togglePasswordVisibility() {
    var passwordField = document.getElementById("pass");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

// Chuyển đổi khả năng hiển thị cho mật khẩu đăng ký
function toggleRegPasswordVisibility() {
    var regPasswordField = document.getElementById("reg_pass");
    var confirmPasswordField = document.getElementById("confirm_pass");
    if (regPasswordField.type === "password") {
        regPasswordField.type = "text";
        confirmPasswordField.type = "text";
    } else {
        regPasswordField.type = "password";
        confirmPasswordField.type = "password";
    }
}

// Hiển thị mẫu đăng ký và ẩn mẫu đăng nhập
function showRegistrationForm() {
    document.getElementById("loginForm").classList.add("hidden");
    document.getElementById("registrationForm").classList.remove("hidden");
}

//Hiển thị mẫu đăng nhập và ẩn mẫu đăng ký
function showLoginForm() {
    document.getElementById("registrationForm").classList.add("hidden");
    document.getElementById("loginForm").classList.remove("hidden");
}

// Xác thực biểu mẫu
function validateForm() {
    var password = document.getElementById("reg_pass").value;
    var confirmPassword = document.getElementById("confirm_pass").value;
    if (password !== confirmPassword) {
        document.getElementById("errorModal").style.display = "flex";
        return false;
    }
    return true;
}

// Close modal
function closeModal() {
    document.getElementById("errorModal").style.display = "none";
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById("errorModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
