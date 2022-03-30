<?php
include 'connection.php';
$id = $_GET['usid'];
$sql="DELETE FROM `users` WHERE `id`='$id'";
$run=mysqli_query($conn,$sql);
header("Location:dispusr.php");
?>