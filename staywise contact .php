<?php

// Database connection
$conn = mysqli_connect("localhost","root","","staywise");

// Check connection
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}


// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


// Insert into database
$sql = "INSERT INTO contact(name,email,subject,message)
VALUES('$name','$email','$subject','$message')";


if(mysqli_query($conn,$sql)){
    echo "Message sent successfully";
}
else{
    echo "Error";
}


mysqli_close($conn);

?>
