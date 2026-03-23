<?php

session_start();

$conn=mysqli_connect("localhost","root","","staywise");

if(!$conn){
die("Database error");
}


// users count
$userQuery="SELECT COUNT(*) as total FROM users";
$userResult=mysqli_query($conn,$userQuery);
$users=mysqli_fetch_assoc($userResult);


// messages count
$msgQuery="SELECT COUNT(*) as total FROM contact";
$msgResult=mysqli_query($conn,$msgQuery);
$messages=mysqli_fetch_assoc($msgResult);


// comments count
$comQuery="SELECT COUNT(*) as total FROM comments";
$comResult=mysqli_query($conn,$comQuery);
$comments=mysqli_fetch_assoc($comResult);


// last searches
$searchQuery="SELECT * FROM searches ORDER BY date DESC LIMIT 5";
$searchResult=mysqli_query($conn,$searchQuery);


// last comments
$lastCom="SELECT * FROM comments ORDER BY date DESC LIMIT 5";
$lastComResult=mysqli_query($conn,$lastCom);

?>

<!DOCTYPE html>
<html>

<head>

<title>StayWise Admin</title>

<style>

body{

font-family:Arial;
margin:0;
background:#f4f6f9;

}

.header{

background:#4e73df;
color:white;
padding:15px;

}

.dashboard{

display:flex;
gap:20px;
padding:20px;

}

.card{

background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
width:200px;
text-align:center;

}

.table{

background:white;
margin:20px;
padding:20px;
border-radius:10px;

}

table{

width:100%;
border-collapse:collapse;

}

th,td{

padding:10px;
border-bottom:1px solid #ddd;

}

</style>

</head>

<body>

<div class="header">

<h2>StayWise Admin Dashboard</h2>

</div>


<div class="dashboard">

<div class="card">

<h3>Users</h3>

<h1><?php echo $users['total']; ?></h1>

</div>


<div class="card">

<h3>Messages</h3>

<h1><?php echo $messages['total']; ?></h1>

</div>


<div class="card">

<h3>Comments</h3>

<h1><?php echo $comments['total']; ?></h1>

</div>

</div>


<div class="table">

<h3>Last Searches</h3>

<table>

<tr>

<th>City</th>

<th>Price</th>

<th>Stars</th>

<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($searchResult)){

echo "<tr>

<td>".$row['city']."</td>

<td>".$row['price']."</td>

<td>".$row['stars']."</td>

<td>".$row['date']."</td>

</tr>";

}

?>

</table>

</div>


<div class="table">

<h3>Last Comments</h3>

<table>

<tr>

<th>Hotel</th>

<th>User</th>

<th>Comment</th>

<th>Stars</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($lastComResult)){

echo "<tr>

<td>".$row['hotel']."</td>

<td>".$row['user']."</td>

<td>".$row['comment']."</td>

<td>".$row['stars']." ⭐</td>

</tr>";

}

?>

</table>

</div>


</body>

</html>
