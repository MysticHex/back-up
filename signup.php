<?php
include 'connection.php';

date_default_timezone_set('Asia/Jakarta');
$timestamp = date('h:i A d/m/Y');

$fn = (isset($_POST['fullname']))?$_POST['fullname']:"";
$username = (isset($_POST['usn']))?$_POST['usn']:"";
$pass = (isset($_POST['pass']))?$_POST['pass']:"";
$pass2 = (isset($_POST['pass2']))?$_POST['pass2']:"";

if (isset($_POST['btn'])) {
    if ($pass == $pass2) {
        $passenk=password_hash($pass,PASSWORD_DEFAULT);
        $quer = "SELECT * FROM `users` WHERE username = '$username' ";
        $result = mysqli_query($conn, $quer);
        // error_reporting(0);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $reg = "INSERT INTO `users` (`username`, `password`, `fullname`, `created_at`) VALUES ('$username','$passenk','$fn','$timestamp')";
            $run = mysqli_query($conn, $reg);
            if ($run) {
                echo "
                <script>
                alert('Registration Succes');
                document.location.href='login.html';
                </script>";
                // header('Refresh: 0.2; URL=login.html');
            } else {
                echo "<script>alert('Registration Failed')</script>";
            }
        } else {
            echo "<script>alert('Username already taken')<script>";
            header('Refresh: 0.2; URL=signup.html');
        }
    } else {
        echo '<script>alert("Konfirmasi password gagal")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
        function showHide(pass, tgl) {
            const password = document.getElementById(pass);
            const toggle = document.getElementById(tgl);
            if (password.type === 'password') {
                password.setAttribute('type', 'text');
                toggle.classList.add('hide')
            }
            else {
                password.setAttribute('type', 'password');
                toggle.classList.remove('hide')
            }
        }
    </script>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    
    <div class="signup-box md">
        <div style="padding-top: 50px;"></div>
        <p class="blur" id="head">
            CoursLib
        </p>
        <div style="padding-top: 15px;"></div>
        <h4>Sign Up CoursLib</h4>
        <p class="blur" id="wlcm">Hello! Welcome to CoursLib</p>
        <div style="margin-bottom: 10%;"></div>
        <div class="form">
            <form action="signup.php" method="post">
                <!-- Awal input Name -->
                <div>
                    <label for="">NAME</label><br>
                    <input type="text" name="fullname" id="" class="inp" placeholder="Full Name">
                </div>
                <!-- Akhir input Name -->

                <!-- Input email -->
                <div>
                    <label for="">USERNAME</label><br>
                    <input type="text" name="usn" id="" class="inp" placeholder="Username">
                </div>
                <!-- end input email -->
                
                <!-- Select user type -->
                <div>
                    <label for="">User type</label><br>
                    <select name="" id="" class="inp">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <!-- END Select user type -->
                <!-- Input Password confirmation-->
                <div class="pass">
                    <label for="">PASSWORD</label><br>

                    <input type="password" name="pass" id="password" class="inp pass" placeholder="Password">

                    <div id="toggle" onclick="showHide('password','toggle')"></div>
                </div>
                <div class="passcon">
                    <label for="">CONFIRMATION PASSWORD</label><br>

                    <input type="password" name="pass2" id="pass2" class="inp pass" placeholder="Password">

                    <div id="toggle2" onclick="showHide('pass2','toggle2');"></div>
                </div>
                <!--End Input Password confirmation-->

                <!-- Spasi -->
                <div style="margin: 16px;"></div>

                <!-- Awal SignUp Button -->
                <div>
                    <input type="submit" name="btn" value="Sign Up" class="inp btn btn-primary">
                </div>
                <!-- Akhir SignUp Button -->
            </form>
            <div class="login">
                <p>Already have an account?</p>
                <a href="login.php">Log In</a>
            </div>
        </div>
        <div style="padding-top: 12px;"></div>
    </div>


</body>

</html>