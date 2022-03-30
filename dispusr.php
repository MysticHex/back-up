<?php
include 'connection.php';
include 'disperror.php';
session_start();
// $rmbr=(isset($_SESSION['%&%']));
$rmbr2=$_SESSION['%&%%'];

if(isset($rmbr)){
    header('Location:h1.php');
    exit;
}
else if(!isset($_SESSION['%&%%'])){
    header('Location:login.php');
    exit;
}


$quer="SELECT * FROM `users`";
// echo $quer;
$result=mysqli_query($conn,$quer);


// $halamanAktif=(isset($_GET['halaman']))?$_GET['halaman']:1;

// $awalData=($jumlahPerHalaman * $halamanAktif)-$jumlahPerHalaman;

// $sql="$quer LIMIT $awalData, $jumlahPerHalaman";

// $result=mysqli_query($conn,$sql);

// Untuk add user
$usn = (isset($_POST['username'])) ? $_POST['username'] :"";
$fn = (isset($_POST['fn'])) ? $_POST['fn'] :"";
$ustyp = (isset($_POST['user_type'])) ? $_POST['user_type'] :"";
$pass = (isset($_POST['pass'])) ? $_POST['pass'] :"";

date_default_timezone_set('Asia/Jakarta');
$timestamp = date('h:i A d/m/Y');

if (isset($_POST['btn'])) {
    $passenk=password_hash($pass,PASSWORD_DEFAULT);
    $quer = "SELECT * FROM `users` WHERE username = '$usn' ";
    $resultadd = mysqli_query($conn, $quer);
    // error_reporting(0);
    $num = mysqli_num_rows($resultadd);
    if ($num == 0) {
        $reg = "INSERT INTO `users`
                (`username`, `password`, `fullname`, `created_at`,`user_type`) 
                VALUES  
                ('$usn','$passenk','$fn','$timestamp','$ustyp')";
        $run = mysqli_query($conn, $reg);

        if ($run) {
            echo"
                <script>
                    alert('Registration Succes');
                </script>
            ";
            header('Refresh: 0.5;');
            exit;
        } else {
            echo"
                <script>
                        alert('Registration Failed')
                </script>
                ";
        }
    }
    else {
    echo "
            <script>
                alert('Username already taken')
            <script>
        ";
    header('Refresh: 0.2;');
    }
}
// Selesai add user
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display user</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <style>
   
    </style>
</head>
<body>
    <div style="margin-bottom:20px;"></div>
    <a href="session.php"><button>Logout</button></a>
    <details>
        <summary>Add user?</summary>
        <div class="inp">
            <form action="" method="post">
                <input type="text" name="username" placeholder="Masukan username" id="" required>
                <div style="margin-bottom:4px;"></div>
                <input type="text" name="fn" placeholder="Masukan nama" id="" required>
                <div style="margin-bottom:4px;"></div>
                <select name="user_type" id="" required style="width: 147px; padding: 1px 2px; ">
                    <option value="" selected disabled>User type</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select><br>
                <div style="margin-bottom:4px;"></div>
                <input type="password" name="pass" id="" placeholder="masukan password"><br>
                <div style="margin-bottom:4px;"></div>
                <input type="submit" value="Submit" name="btn">
            </form>
        </div>
    </details>
    <div id="container">
    <table border=1>
        <tr>
            <td>Id</td>
            <td>Nama</td>
            <td>Username</td>
            <td>User Type</td>
            <td >Created At</td>
            <td >Update At</td>
            <td style="text-align:center;">Operation</td>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $id=$row['id'];
            $username=$row['username'];
            $fullname=$row['fullname'];
            $ca=$row['created_at'];
            $ua=$row['update_at'];
            $user_type=$row['user_type'];
            ?>
        <tr>
            <td><?= $id; ?></td>
            <td><?= $fullname; ?></td>
            <td><?= $username; ?></td>
            <td><?= $user_type; ?></td>
            <td><?= $ca; ?></td>
            <td><?= $ua; ?></td>
            <td><a href="update.php?usid=<?=$id;?>"><button>Update</button></a>
            <a href="delete.php?usid=<?=$id;?>"><button>Delete</button></a></td>
        </tr>
        <?php }?>
    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>