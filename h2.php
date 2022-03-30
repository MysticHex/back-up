<?php
    include 'connection.php';
    include 'disperror.php';

    if (isset($_GET['keyword'])) {
        $keyword=$_GET['keyword'];
        if($keyword!=null){
        $sql="SELECT * FROM `files`
        WHERE
        `id` = '$keyword' OR `judul` = '$keyword' OR `author` = '$keyword' OR `file_type_id` = '$keyword' OR `isi` = '$keyword' OR `created_at` = '$keyword'
        ORDER BY
            `created_at`
        ASC";
        $result=mysqli_query($conn,$sql);
        }else{
            $sql="SELECT * FROM `files` ORDER BY `id` DESC";
            $result=mysqli_query($conn,$sql);   
            header('location:h2.php');
        }
    }else{
        $sql="SELECT * FROM `files` ORDER BY `created_at` DESC";
        $result=mysqli_query($conn,$sql);
        // header('location:h2.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View all</title>

</head>
<body>
    <form action="" method="get">
        <input type="text" name="keyword" id="">
        <button type="submit">Submit</button>
    </form>
    <div style="margin-bottom: 20px;"></div>
    <?php while($row=mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $isi=$row['isi'];
        $fileType=$row['file_type_id'];
        $judul=$row['judul'];
        $nama=$row['author'];
        $ca=$row['created_at'];
        $ua=$row['update_at'];
        ?>

        <table border="1">
            <?php if($fileType==='video') {?>
                <tr>
                    <video controls src="./uploads/<?=$isi?>" width="360px"></video>
                </tr>
            <?php } ?>

            <?php if($fileType==='image') {?>
                <tr>
                    <img src="uploads/<?=$isi?>" alt="Gambar <?=$judul?>" width=360px;>
                </tr>
            <?php } ?>
            
            <?php if($fileType==='Artikel') {?>
                <tr>
                    <div class="" style="width:360px; height:fit-content;  border: 1px solid black; padding-left:5px;">
                        <?= $isi; ?>
                    </div>
                </tr>
            <?php } ?>

            <?php if($fileType==='document') {?>
                    <?php
                        $docex=pathinfo($isi,PATHINFO_EXTENSION);
                        $doc_ex_lc=strtolower($docex);                     
                    ?>
                <tr>
                    <?php if($doc_ex_lc==="pdf") {?>
                        <iframe src="./uploads/<?=$isi?>" frameborder="0"></iframe>
                    <?php }else{ ?>
                        
                    <?php } ?>
                </tr>
            <?php } ?>
                <tr>
                    <ul style="list-style-type: none;">
                        <li>Nama: <?= $nama; ?></li>
                        <li>Judul: <?= $judul; ?></li>
                        <li>Dibuat: <?= $ca; ?></li>
                        <?php if(isset($ua)) {?>
                            <li>Diupdate:<?= $ua; ?></li>
                        <?php } ?>
                    </ul>
                </tr>
        </table>

    <?php } ?>
</body>
</html>