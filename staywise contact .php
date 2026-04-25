<?php

// اتصال قاعدة البيانات
$conn = mysqli_connect("localhost", "root", "", "staywise");

// التحقق من الاتصال
if (!$conn) {
    die("خطأ في الاتصال: " . mysqli_connect_error());
}

// التحقق من وجود البيانات المرسلة
if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
    die('جميع الحقول مطلوبة');
}

// الحصول على بيانات النموذج
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

// التحقق من عدم ترك الحقول فارغة
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die('جميع الحقول مطلوبة ولا يمكن أن تكون فارغة');
}

// التحقق من صيغة البريد الإلكتروني
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('البريد الإلكتروني غير صحيح');
}

// التحقق من طول الرسالة
if (strlen($message) < 10) {
    die('الرسالة يجب أن تكون أطول من 10 أحرف');
}

// استخدام prepared statement للحماية من SQL Injection
$sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "تم إرسال الرسالة بنجاح";
} else {
    echo "خطأ في إرسال الرسالة: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>