<?php
if(!(isset($_GET['username']))){
    header("Location: ../index.html");
    exit;
}
if($_GET['username']=='sachin'&&$_GET['password']=='sachin12'){
  echo '<script type="text/JavaScript">
  alert("Login Success");
  </script>';
}
else{
    echo '<script type="text/JavaScript">
    alert("Invalid username or password");
    window.location="../index.html";
    </script>';
}

$insert = true;
$server = "localhost";
$username = "root";
$password = "";
$db="rest";

$con = mysqli_connect($server, $username, $password ,$db);
if(!$con){
    die("connect failed");
}

$sql = "select * from user_def";
$result = $con->query($sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<style>
body{
  font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #99ccff;
    padding-bottom:30px;
}
.container{
  width: 80%;
  margin-left: auto;
  margin-right: auto;
  padding-top: 5px;
  background-color: #4da6ff;
  border-radius: 5px;
  margin-bottom:10px;
}
header{
  display: flex;
  justify-content: space-between;
  padding: 14px 20px 14px 20px;
  margin: 0px;
  background-color: #330033;
}
header a{
  text-align: center;
  text-decoration: none;
  font-size: 30px;
  color: white;
  opacity:0.7;
}
header img{
  width: 30px;
  height: 30px;
  margin-right: 10px;
}
header a:hover{
  opacity:1;
}
#logo{
    display: flex;
    align-items: center;
}
.div-1,.div-2,.div-in{
  display: flex;
  justify-content: space-between;
  color: #404040;
  font-size: 13px;
}
p{
  margin-top: 4px;
  margin-bottom: 4px;
}
img{
  height: 15px;
}
.div-3{
  padding: 7px;
  text-align: center;
  background-color: #ecb3ff;
  border-radius: 5px;
  cursor: pointer;
}
.div-3:hover{
  background-color: #ac00e6;
}
.hidden{
  display: none;
  background-color: #cce6ff;
  margin: 10px;
  padding: 10px;
  border-radius: 5px;
}
.div-1,.div-2{
  margin-left: 10px;
  margin-right: 10px;
  padding-left: 10px;
  padding-right: 10px;
}
h1{
  text-align: center;
  color: #595959;
}
.no-orders{
  text-align:center;
  color: #404040;
}
.no-orders img{
  height: 500px;
  width: 300px
}

</style>
<body>
    <header>
          <a href="../index.html" id="logo"><img src="../img/salad.png" alt="icon">FoodArc</a>
          <a href="../index.html">Logout</a>
    </header>
    <h1>Orders Placed</h1>
    <?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $temp = $row['order_no'];
    $sql1 = "select food,amount from orders where order_no='$temp';";
    $result1 = $con->query($sql1);
    echo '<div class="container">
    <div class="div-1">
      <p>Order no.: '.$row["order_no"].'</p>
      <p>Date: '.$row["date"].'</p>
      <p>Total amount: &#8377 '.$row["total"].'</p>
    </div>
    <div class="div-2">
      <p>Placed By: '.$row["name"].'</p>
      <p>Address: '.$row["address"].'</p>
    </div><div class="hidden">';
    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()) {
        echo 
          ' <div class="div-in">
              <p>'.$row1["food"].'</p>
              <p>&#8377 '.$row1["amount"].'</p>
            </div>';
    
  }
  } else {
    echo "0 results";
  }
  echo '</div><div class="div-3" onclick="expand(this)"><img src="../img/down-chevron.png" alt=""></div>
  </div>';
  }
} else {
  echo '<div class="no-orders"><img src="../img/noitem.svg" alt="icon"><p>No Orders Yet</p></div>';
}
    ?>
    
    <script>
      function expand(clicked_id){
        if(clicked_id.previousElementSibling.style.display=="none"||clicked_id.previousElementSibling.style.display==""){
          clicked_id.previousElementSibling.style.display = "block";
          clicked_id.children[0].src = '../img/up-chevron.png';
        }
        else{
          clicked_id.previousElementSibling.style.display = "none";
          clicked_id.children[0].src = '../img/down-chevron.png';
        }
      }
    </script>
</body>
</html>