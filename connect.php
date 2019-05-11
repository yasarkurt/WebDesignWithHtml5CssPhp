<?php 
$username="root";
$password="";
$host="localhost";
$port="3306";
$dbname="subway";

$connect=mysqli_connect($host,$username,$password,$dbname,$port);
if(mysqli_connect_error()){
    echo "bağlantı hatası";
}else{
    mysqli_set_charset($connect,"utf8");
}
?>