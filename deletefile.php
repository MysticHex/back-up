<?php

use function PHPSTORM_META\type;

    include 'connection.php';
    include 'disperror.php';

    $id=$_GET['url'];

    echo $id."<br>";
    

    $sql="SELECT * FROM `files` WHERE `id`='$id';";

    $run=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($run);
    $isi=$row['isi'];
    $path='uploads/'.$isi;
    echo $path;

    $ssql="DELETE FROM `files` WHERE `id`='$id'";
    $rrun=mysqli_query($conn,$ssql);

    $sssql="DELETE FROM `assignment` WHERE `file_id`=$id";
    $rrrun=mysqli_query($conn,$sssql);
    
    if(unlink("$path")&&$rrun&&$rrrun){
        header('locatin:h2_2.php?sm=Delete berhasil');
    }else{
        header('Location:h2_2.php?em=Terjadi sebuah error');
    }
    
?>