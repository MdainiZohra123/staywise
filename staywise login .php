<?php

session_start();

// اتصال قاعدة البيانات
$conn = mysqli_connect("localhost", "root", "", "staywise");

if (!$conn) {
    die("خطأ في الاتصال: " . mysqli_connect_error());
}

// التحقق من البيانات المرسلة
if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['role'])) {
    die('جميع البيانات مطلوبة');
}

// الحصول على البيانات
$email = trim($_POST['email']);
$password = $_POST['password'];
$role = trim($_POST['role']);

// التحقق من الحقول الفارغة
if (empty($email) || empty($password) || empty($role)) {
    die('جميع الحقول مطلوبة');
}

// التحقق من صيغة البريد
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('البريد الإلكتروني غير صحيح');
}

// البحث عن المستخدم - استخدام prepared statement
$sql = "SELECT * FROM users WHERE email=? AND role=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $role);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // التحقق من كلمة المرور المشفرة
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];
        
        // التوجيه حسب الدور
        if ($role === "admin") {
            header("Location: admin.html");
        } else {
            header("Location: travel.html");
        }
        exit();
    } else {
        echo "كلمة المرور غير صحيحة";
    }
} else {
    echo "المستخدم غير موجود أو الدور غير صحيح";
}

$stmt->close();
mysqli_close($conn);
?>