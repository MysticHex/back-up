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
        $count=mysqli_num_rows($result);
        if($count==0){
            header('Location:h2_2.php?em=Pencarian tidak ada');
        }
        }else{
            $sql="SELECT * FROM `files` ORDER BY `id` DESC";
            $result=mysqli_query($conn,$sql);   
            header('location:h2_2.php');
        }
    }else{
        $sql="SELECT * FROM `files` ORDER BY `id` DESC";
        $result=mysqli_query($conn,$sql);
        // header('location:h2_2.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View all</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body class="p-3">
    <?php if(isset($_GET['em'])) {?>
        <div class="alert alert-danger">
            <?=$_GET['em']?>
        </div>
    <?php } ?>
    
    <?php if(isset($_GET['sm'])) {?>
        <div class="alert alert-success">
            <?= $_GET['sm']; ?>
        </div>
    <?php } ?>    
    
    <?php if(isset($_GET['em'])!=null ||isset($_GET['sm'])!=null) {?>
        <script>
            if (performance.navigation.type === 1) {
                    window.location.href = 'h2_2.php';
            }
        </script>
    <?php } ?>


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

        // mysqli_query($conn,"SELECT * FROM `files` WHERE ")

        ?>

        <table>
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
                    <td style="height: fit-content;">
                        <ul style="list-style-type: none; height: fit-content; margin:0;">
                            <li>id: <?= $id; ?></li>
                            <li>Nama: <?= $nama; ?></li>
                            <li>Judul: <?= $judul; ?></li>
                            <li>Dibuat: <?= $ca; ?></li>
                            <?php if(isset($ua)) {?>
                                <li>Diupdate:<?= $ua; ?></li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <a href="updatefile.php?url=<?=$id?>"><button>Update</button></a>
                        <a href="deletefile.php?url=<?=$id?>" onclick="return confirm('Yakin untuk delete?');"><button>Delete</button></a>
                        <div style="margin-bottom: 15px;"></div>
                    </td>
                </tr>
        </table>

    <?php } ?>
</body>
</html>