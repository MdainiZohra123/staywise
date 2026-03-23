<?php

session_start();

$conn=mysqli_connect("localhost","root","","staywise");

if(!$conn){

die("Database error");

}

if(!isset($_SESSION['user'])){

header("Location: login.html");

}

?>


<!DOCTYPE html>

<html>

<head>

<title>StayWise Travel</title>

<style>

body{

margin:0;
font-family:Arial;
background: linear-gradient(to right,#4e73df,#1cc88a);

}

nav{

background:white;
padding:15px;
display:flex;
justify-content:space-between;

}

.hotels{

width:80%;
margin:auto;
padding:20px;

}

.hotel{

background:white;
padding:15px;
margin-bottom:20px;
border-radius:10px;

}

.hotel img{

width:100%;
height:200px;
object-fit:cover;

}

textarea{

width:100%;
margin-top:10px;

}

button{

padding:8px 15px;
background:#4e73df;
color:white;
border:none;
border-radius:20px;
cursor:pointer;

}

.stars span{

font-size:22px;
cursor:pointer;
color:gray;

}

.active{

color:gold;

}

</style>

</head>


<body>

<nav>

<h2>StayWise</h2>

<div>

Welcome <?php echo $_SESSION['user']; ?>

<a href="logout.php">Logout</a>

</div>

</nav>


<div class="hotels">

<?php

$sql="SELECT * FROM hotels";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){

?>

<div class="hotel">

<h3><?php echo $row['name']; ?></h3>

<img src="<?php echo $row['image']; ?>">

<p>City: <?php echo $row['city']; ?></p>

<p>Price: <?php echo $row['price']; ?> $</p>

<p>Stars: <?php echo $row['stars']; ?></p>


<form action="comment.php" method="POST">

<input type="hidden" name="hotel"
value="<?php echo $row['name']; ?>">


<div class="stars">

<span onclick="rate(this)">★</span>

<span onclick="rate(this)">★</span>

<span onclick="rate(this)">★</span>

<span onclick="rate(this)">★</span>

<span onclick="rate(this)">★</span>

</div>

<input type="hidden" name="stars" id="stars">


<textarea name="comment"
placeholder="Write comment"></textarea>

<button type="submit">

Add Comment

</button>

</form>

</div>

<?php

}

?>

</div>


<script>

function rate(element){

let stars=element.parentElement.children;

let value=0;

for(let i=0;i<stars.length;i++){

stars[i].classList.remove("active");

}

for(let i=0;i<=element.index;i++){

stars[i].classList.add("active");

value++;

}

document.getElementById("stars").value=value;

}

</script>

</body>

</html>
