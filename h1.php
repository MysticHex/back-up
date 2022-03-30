<?php
session_start();
$rmbr=$_SESSION['%&%'];
$rmbr2=$_SESSION['%&%%'];

if(isset($rmbr2)){
    header('Location:dispusr.php');
    exit;
}
else if(!isset($_SESSION['%&%'])){
    header('Location:login.php');
    exit;
}

include 'connection.php';
$pilihan = "";

// untuk check apa ada inputan pilihan
if (isset($_GET['pilihan']) && $_GET['pilihan'] != "") {
    $pilihan = $_GET['pilihan'];
}
// echo $rmbr;
$sql=mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='$rmbr'");
$row=mysqli_fetch_assoc($sql);
$fn=$row['fullname'];

date_default_timezone_set('Asia/Jakarta');
$timestamp = date('d/m/Y h:i A');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#format'
            });
        </script>
        <style>
            input{
                margin-bottom: 10px;
            }.alert{
                text-align: center;
                width: fit-content;
                padding: 10px;
                border-radius: 25px;
                margin-bottom: 10px;
                transform: scale(0.8);
            }.danger{
                background: red;
                color: white;
            }.succes{
                background: greenyellow;
                color: black;
            }#a{
                text-decoration: none;
                color: black;
                transition-duration: 0.51s;
            }#a:hover{
                color:blue;
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <form action="" method="post">
            <button name="btn">Logout</button>
        </form>
        <?php
        if (isset($_POST['btn'])) {
            session_destroy();
            header('Refresh:0.1');
            exit;
        }?>
        <div style="margin-bottom: 10px;"></div>
        <form action="" method="get">
            <select name="pilihan" id="pilihan" onchange="this.form.submit()">
                <option selected disabled value="">Select an Option</option>
                <option value="Video" <?php echo ($pilihan === "Video") ? "selected" : "" ?>>Video</option>
                <option value="Artikel" <?php echo ($pilihan === "Artikel") ? "selected" : "" ?>>Artikel</option>
                <option value="artdok" <?php echo ($pilihan === "artdok") ? "selected" : "" ?>>Artikel (dokumen)</option>
                <option value="image" <?php echo ($pilihan === "image") ? "selected" : "" ?>>Image</option>
            </select>
        </form>
        <div style="margin-bottom:10px;"></div>
        <?php if(isset($_GET['sm'])) {?>
            <div class="alert succes">
                <a target="_BLANK" id="a" href="h2.php"><?= $_GET['sm']; ?></a>
            </div>
        <?php } ?>
        <?php if(isset($_GET['em'])) {?>
            <div class="alert danger">
                <?= $_GET['em']; ?>
            </div>
        <?php } ?>
        
        <?php if ($pilihan == "Video") { ?>
            <form action="upload_vid.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nama" placeholder="Masukan nama" autocomplete="off" id="" value="<?= $fn?>">
                <div style="margin-bottom: 5px;"></div>
                
                <input type="text" name="judul" placeholder="Masukan judul" id="" autocomplete="off"><br>
                <div style="margin-bottom: 5px;"></div>
                
                <input type="file" name="my_video" id="my_video"><br>
                <small>format file harus (*.mp4)</small>

                <div style="margin-bottom: 5px;"></div>
                <input type="submit" name="btnSubmit" value="Submit">
            </form>

            <?php if($_GET['em']!=null ||$_GET['sm']!=null) {?>
            <script>
                if (performance.navigation.type === 1) {
                        window.location.href = 'h1.php?pilihan=Video';
                }
            </script>
            <?php } ?>
        <?php } ?>

        <?php if ($pilihan == "Artikel") { ?>
            <form action="upload_Artikel.php" method="post">
                <input type="text" name="nama2" id="" placeholder="Masukan nama" autocomplete="off" value="<?= $fn?>"><br>
                <input type="text" name="judul2" placeholder="masukan judul" id="" autocomplete="off"><br>
                <textarea style="width: 360px;" name="isi2" id="format" cols="30" rows="20"></textarea><br>
                <input type="submit" name="btnSubmit2" value="Submit">
            </form>

            <?php if($_GET['em']!=null ||$_GET['sm']!=null) {?>
                <script>
                    if (performance.navigation.type === 1) {
                            window.location.href = 'h1.php?pilihan=Artikel';
                    }
                </script>
            <?php } ?>

        <?php } ?>
            
        <?php if($pilihan=="artdok") {?>
            <form action="upload_dok.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nama3" id="" placeholder="Masukan nama" autocomplete="off" value="<?= $fn?>">
                <div style="margin-bottom: 5px;"></div>
                
                <input type="text" name="judul3" placeholder="Masukan judul" id="" autocomplete="off">
                <div style="margin-bottom: 5px;"></div>
                
                <input type="file" name="file3" id=""><br>
                <small>format file harus (*.doc,*.pdf)</small>
                
                <div style="margin-bottom: 5px;"></div>
                <input type="submit" value="Submit" name="btn3">
            </form>

            <?php if($_GET['em']!=null ||$_GET['sm']!=null) {?>
            <script>
                if (performance.navigation.type === 1) {
                        window.location.href = 'h1.php?pilihan=artdok';
                }
            </script>
            <?php } ?>
        <?php } ?>
            
        <?php if($pilihan=="image") {?>
            <form action="upload_img.php" method="post" enctype="multipart/form-data" multiple>
                <input type="text" name="nama_4" id="" placeholder="Masukan nama" autocomplete="off" value="<?= $fn?>">
                <div style="margin-bottom: 5px;"></div>
                
                <input type="text" name="judul_4" placeholder="Masukan judul" id="" autocomplete="off">
                <div style="margin-bottom: 5px;"></div>
                
                <input type="file" name="file_4[]" id="" multiple ><br>
                <!-- <small>format file harus (*.doc,*.pdf)</small> -->
                
                <div style="margin-bottom: 5px;"></div>
                <input type="submit" value="Submit" name="btn_4">
            </form>
            <?php if($_GET['em']!=null ||$_GET['sm']!=null) {?>
            <script>
                if (performance.navigation.type === 1) {
                        window.location.href = 'h1.php?pilihan=image';
                }
            </script>
            <?php } ?>
        <?php } ?>

    </body>
</html>