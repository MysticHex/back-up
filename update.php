<?php
    include 'connection.php';
    $id=$_GET['usid'];

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('h:i A d/m/Y');
    
    $sql="SELECT * FROM `USERS` WHERE `id` = '$id'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $username=$row['username'];
    $fullname=$row['fullname'];
    $ua=$row['update_at'];
    $pass=$row['password'];

    if(isset($_POST['btn'])){
        $usn = (isset($_POST['usn']))?$_POST['usn']:"";
        $fn = (isset($_POST['fn']))?$_POST['fn']:"";
        $password = (isset($_POST['pass']))?$_POST['pass']:"";
        $passenk=password_hash($password,PASSWORD_DEFAULT);
        $run=mysqli_query($conn,"UPDATE `users` SET `username`='$usn',`password`='$passenk',`fullname`='$fn',`update_at`='$timestamp' WHERE `id`='$id'");
        if ($run) {
            $succes = true;
            header("Location:dispusr.php");
        }else if (!$run) {
            $succes = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php if ($succes==true) {?>
        <div>
            <p>Update succes</p>
        </div>
    <?php }?>
    <form action="" method="post">
        <label for="fn">Fullname</label><br>
        <input type="text" name="fn" id="fn" value="<?= $fullname; ?>"><br>

        <label for="Username">Username</label><br>
        <input type="text" name="usn" id="Username" value="<?= $username; ?>" placeholder="Masukan Username"><br>
        
        <label for="password">Password</label><br>
        <input type="text" name="pass" id="password" value="<?= $pass; ?>"><br><br> 

        <input type="submit" value="Submit" name="btn">
    </form>
</body>
</html>