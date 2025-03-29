<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'hotel_management';
$conn = mysqli_connect($hostname,$username,$password,$database);
if(!$conn){
    die('Connection Failed'.mysqli_connect_error());

}
session_start();
session_regenerate_id();
?>