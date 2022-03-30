<?php
include 'connection.php';
session_start();

if (isset($_POST['btn'])) {
    $usn = (isset($_POST['usn'])) ? $_POST['usn'] : "";
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : "";
    $quer = "SELECT * FROM `users` WHERE `username` = '$usn'";
    $result = mysqli_query($conn, $quer);
    $num = mysqli_num_rows($result);

    if ($num === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row["password"])) {
            if ($row['user_type']=='admin') {
                $_SESSION['%&%%']=$usn;
                header("Location:dispusr.php");
                exit;
            } else if ($row['user_type']=='user') {
                $_SESSION['%&%']=$usn;
                header("Location:h1.php");
                exit;
            }
            
        }
    }
    $error = true;
}
if(isset($_SESSION['%&%%'])){
    header('Location:dispusr.php');
    exit;
}else if(isset($_SESSION['%&%'])){
    header('Location:h1.php');
    exit;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-box">
        <div style="padding-top: 50px;"></div>
        <p class="blur" id="head">
            CoursLib
        </p>
        <div style="margin-bottom: 32px;"></div>
        <h4>
            Log In to CoursLib
        </h4>
        <p id="sub" class="blur">
            Enter your email and password below
        </p>
        <div>
            <?php if (isset($error)) { ?>
                <div style="padding:5px; width:316px" class="alert small alert-danger text-center mb-0 mx-auto ">
                    Username or password incorrect
                </div>
            <?php } ?>
            <br>
        </div>
        <div class="input-box">
            <form action="" method="post">
                <div>
                    <label for="">Username</label><br>
                    <input class="inp" type="text" name="usn" id="" placeholder="Username"><br>
                </div>
                <div style="margin-bottom: 32px;"></div>
                <div class="password">
                    <p>PASSWORD</p>
                    <a id="link" href="">Forgot password?</a>
                    <input type="password" class="inp" name="pass" id="password" placeholder="Password">
                    <div id="toggle" onclick="showHide('password','toggle')"></div>
                </div>
                <div style="margin-bottom: 24px;"></div>
                <div>
                    <input type="submit" class="inp btn btn-primary" name="btn" value="Login">
                </div>
            </form>
        </div>
        <div style="margin-bottom: 32px;"></div>
        <div class="signup">
            <p class="blur">Don't have an account?</p>
            <a href="signup.php">Sign Up</a>
        </div>
        <div style="margin-bottom: 20px;"></div>
    </div>
    <script>
        function showHide(pass, tgl) {
            const password = document.getElementById(pass);
            const toggle = document.getElementById(tgl);
            if (password.type === 'password') {
                password.setAttribute('type', 'text');
                toggle.classList.add('hide')
            } else {
                password.setAttribute('type', 'password');
                toggle.classList.remove('hide')
            }
        }
    </script>
</body>

</html>