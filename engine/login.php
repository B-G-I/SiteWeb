<?php
session_start();
if(isset($_SESSION['email']) && !empty($_SESSION['email']) && isset($_SESSION['pass']) && !empty($_SESSION['pass']) ){
header('Location:../index.html');
}else {

$email = $_POST["email"];
$pass = $_POST["password"];
if(!empty($email) && !empty($pass)){
  $epass = hash("sha512",$pass).md5("univ_bba");
  include_once("connect/connection.php");
  $query = mysqli_query($connect,"SELECT * FROM admin WHERE  email = '$email' AND mdp='$epass'");
  $row = mysqli_num_rows($query);
  if($row > 0){
    echo "ok";
if(isset($_POST['remember'])){
  $_SESSION['email'] = base64($email);
  $_SESSION['pass'] = base64($epass);
}
  }else {
    echo "Error wrong email or password";
  }
}else {
  echo "Verify your email or password";
}
}
 ?>
