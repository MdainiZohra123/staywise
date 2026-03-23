<?php

session_start();

// Database connection
$conn = mysqli_connect("localhost","root","","staywise");

if(!$conn){
die("Connection failed");
}


// Get data
$email = $_POST['email'];
$password = $_POST['password'];


// Check user
$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){

$user = mysqli_fetch_assoc($result);

if($password == $user['password']){

$_SESSION['user']=$user['name'];

header("Location: travel.html");

}
else{

echo "Wrong password";

}

}
else{

echo "User not found";

}
 //  التوجيه حسب الدور
        if ($role === "admin ") {
            header("Location: admin.html");
        } else {
            header("Location: travel.html");
        }
        exit();
mysqli_close($conn);

?>
