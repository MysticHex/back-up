<?php

    include 'connection.php';
    include 'disperror.php';

    if (isset($_GET['url'])) {
        $id=$_GET['url'];
    }else{
        header("Location:h2_2.php");
    }

    echo $id;

    $sql="SELECT * FROM `files` WHERE `id`='$id';";

    $run=mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_assoc($run)) {
        $id=$row['id'];
        $aur=$row['author'];
        $jud=$row['judul'];
        $type=$row['file_type_id'];
        $isi=$row['isi'];
        $ca=$row['created_at'];
        $ua=$row['update_at'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script>
    </head>
    <body>

    
    <table border="1">
        <form action="" method="get">
            <tr>
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="display: inline;">id:</p>
                    <input type="text" disabled value="<?=$id?>">
                    <div style="margin-bottom: 10px;"></div>
                    
                    <input type="text" name="nama" id="" placeholder="Masukan nama" value="<?=$aur?>">
                    <div style="margin-bottom: 10px;"></div>
                    
                    <input type="text" name="judul" id="" value="<?=$jud?>">
                    <div style="margin-bottom: 10px;"></div>
                    
                    <input type="text" name="type" id="" value="<?=$type?>">
                    <div style="margin-bottom: 10px;"></div>
                    
                    <input type="text" name="ca" id="" value="<?=$ca?>">
                    <div style="margin-bottom: 10px;"></div>
                    
                    <?php if(isset($ua)) {?>
                        <input type="text" name="ua" id="" value="<?=$ua?>">
                        <div style="margin-bottom: 10px;"></div>
                    <?php } ?>
                    
                    <button type="submit" name="btn">Submit</button>
                </td>
            </tr>
        </form>
    </table>

    </body>
    </html>
<?php }?>