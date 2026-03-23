<?php
//connected database
$conn=mysqli_connect('localhost','root','staywise');
if (:$conn)
	die('erreur de connection');
//verifie les donnée  
if{ 
isset($_POST ('name'));

$_POST('email');

$_POST ('password');

$_POST('configpass');

$_POST('role');}
























 //  إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users2 (name,email,password, role)
            VALUES ('$name', '$email ','$passeword', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $sql)) {

        //  التوجيه حسب الدور
        if ($role === "admin ") {
            header("Location: admin.html");
        } else {
            header("Location: travel.html");
        }
        exit();

    } else {
        echo "Erreur lors de l'inscription";




































?>