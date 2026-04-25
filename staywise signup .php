<?php
// متصل بقاعدة البيانات
$conn = mysqli_connect('localhost', 'root', '', 'staywise');

if (!$conn) {
    die('خطأ في الاتصال بقاعدة البيانات: ' . mysqli_connect_error());
}

// التحقق من البيانات المرسلة
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['configpass']) && isset($_POST['role'])) {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $configpass = $_POST['configpass'];
    $role = trim($_POST['role']);
    
    // التحقق من أن الحقول ليست فارغة
    if (empty($name) || empty($email) || empty($password) || empty($configpass) || empty($role)) {
        die('جميع الحقول مطلوبة');
    }
    
    // التحقق من صيغة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('البريد الإلكتروني غير صحيح');
    }
    
    // التحقق من تطابق كلمات المرور
    if ($password !== $configpass) {
        die('كلمات المرور غير متطابقة');
    }
    
    // التحقق من قوة كلمة المرور (على الأقل 6 أحرف)
    if (strlen($password) < 6) {
        die('كلمة المرور يجب أن تكون 6 أحرف على الأقل');
    }
    
    // التحقق من عدم وجود بريد مسجل بالفعل
    $checkEmail = "SELECT * FROM users WHERE email='" . mysqli_real_escape_string($conn, $email) . "'";
    $checkResult = mysqli_query($conn, $checkEmail);
    
    if (mysqli_num_rows($checkResult) > 0) {
        die('البريد الإلكتروني مسجل بالفعل');
    }
    
    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    
    // استخدام prepared statement للحماية من SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
    
    if ($stmt->execute()) {
        // التوجيه حسب الدور
        if ($role === "admin") {
            header("Location: admin.html");
        } else {
            header("Location: travel.html");
        }
        exit();
    } else {
        echo "خطأ في التسجيل: " . $stmt->error;
    }
    
    $stmt->close();
    
} else {
    die('يجب إرسال جميع البيانات المطلوبة');
}

mysqli_close($conn);
?>