<?php
$sorgu=mysqli_query($connect,"UPDATE users SET online_date='".date("Y-m-d H:i:s")."' WHERE user_id=".$_SESSION['user_id']);
session_destroy();
setcookie("username", "", strtotime("-15 Days"));
setcookie("password", "", strtotime("-15 Days")); 
header("Refresh: 1; url=index.php")
?>