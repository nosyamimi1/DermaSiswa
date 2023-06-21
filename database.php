<?php
 
$servername = "lrgs.ftsm.ukm.my";
$username = "a181342";
$password = "hugegrayhamster";
$dbname = "a181342";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>